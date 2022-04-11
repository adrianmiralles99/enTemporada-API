<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LikesComentario */

$this->title = 'Create Likes Comentario';
$this->params['breadcrumbs'][] = ['label' => 'Likes Comentarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="likes-comentario-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
