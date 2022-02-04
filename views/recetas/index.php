<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RecetasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recetas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recetas-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Recetas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_usuario',
            'tipo',
            'fecha',
            'id_prodp',
            //'estado',
            //'imagen',
            //'titulo',
            //'tiempo',
            //'comensales',
            //'dificultad',
            //'ingredientes:ntext',
            //'pasos:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Recetas $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
