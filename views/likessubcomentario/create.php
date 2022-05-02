<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Likessubcomentario */

$this->title = 'Create Likessubcomentario';
$this->params['breadcrumbs'][] = ['label' => 'Likessubcomentarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="likessubcomentario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
