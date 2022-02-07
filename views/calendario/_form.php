<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Calendario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="calendario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_prod')->textInput() ?>

    <?= $form->field($model, 'mes')->textInput() ?>

    <?= $form->field($model, 'estado')->dropDownList([ 'T' => 'T', 'I' => 'I', 'F' => 'F', 'N' => 'N', 'B' => 'B', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
