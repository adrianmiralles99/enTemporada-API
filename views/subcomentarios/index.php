<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SubcomentariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subcomentarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subcomentarios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Subcomentarios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_comentarioprinc',
            'id_usuario',
            'texto:ntext',
            'fecha',
            //'estado',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Subcomentarios $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
