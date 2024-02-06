<?php
use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Stores';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="store-index">

<?php
Modal::begin([
    'id' => 'myModal',
    'size' => 'modal-lg',
    'title' => '<h4 class="modal-title">View Details</h4>',
]);
echo '<div class="modal-body">';
echo '<ul id="device-list"></ul>';
echo '</div>';
Modal::end();
?>

<h1><?= Html::encode($this->title) ?></h1>
<p>
        <?= Html::a('Create Store', ['create'], ['class' => 'btn btn-success']) ?>
</p>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        'id',
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a($model->name, 'javascript:void(0);', [
                    'class' => 'open-modal',
                    'data-store-id' => $model->id,
                ]);
            },
        ],
        'created_at',
        [
            'class' => ActionColumn::className(),
            'template' => '{view} {update} {delete}',
            'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('View', $url, [
                        'title' => 'View',
                    ]);
                },
                'update' => function ($url, $model) {
                    return Html::a('Update', $url, [
                        'title' => 'Update',
                    ]);
                },
                'delete' => function ($url, $model) {
                    return Html::a('Delete', $url, [
                        'title' => 'Delete',
                        'data-confirm' => 'Are you sure you want to delete this item?',
                        'data-method' => 'post',
                    ]);
                },
            ],
            'urlCreator' => function ($action, $model, $key, $index) {
                return Url::to([$action, 'id' => $key]);
            },
        ],
    ],
]); ?>

<?php
$js = <<<JS
$(document).on('click', '.open-modal', function() {
    var storeId = $(this).data('store-id');
    var url = $(this).data('url');
    $('#myModal').modal('show');
  
    var deviceList = $('#device-list');
    deviceList.empty();

    $.ajax({
        url: '/store/get-devices', 
        type: 'GET',
        dataType: 'json',
        data: {storeId: storeId},
        success: function(data) {
            $.each(data, function(id, serialNumber) {
                deviceList.append('<li><a href="/device/view?id=' + id + '" target="_blank">' + serialNumber + '</a></li>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Error fetching device list:', status, error);
        }
    });
});
JS;
$this->registerJs($js);
?>