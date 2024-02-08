git clone https://github.com/3HunnaWeight/yii2-test-app.git

composer update

php init 0 yes

frontend->config->main-local
добавить в $config

    'params' => [
        'bsVersion' => '5.x',
    ],
    'modules' => [
        'gridview' =>  [
            'class' => 'kartik\grid\Module',
        ]
    ],
    

docker-compose build

docker-compose up -d

common->config->main-local

    'db' => [
    'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=yii2-test-app-mysql-1;dbname=yii2advanced',
            'username' => 'yii2advanced',
            'password' => 'secret',
            'charset' => 'utf8',
    ]

docker exec -it yii2-test-app-frontend-1 bash

php yii migrate


данные для входа:

имя пользователя - someUser 

пароль - Password123

