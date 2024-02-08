<?php

use common\models\ActiveRecord\Device;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\ActionColumn;
use kartik\grid\GridView;
use kartik\select2\Select2;


/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Devices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Device', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel, 
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'serial_number',
            [
                'attribute' => 'store_id',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'store_id',
                    'data' => Device::getStoreList(), 
                    'options' => ['placeholder' => 'Select a store ...'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]),
                'value' => function ($model) {
                    return $model->store->name; 
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

</div>
