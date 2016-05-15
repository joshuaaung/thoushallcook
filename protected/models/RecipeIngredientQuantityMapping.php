<?php

/**
 * This is the model class for table "Recipe_Ingredient_Quantity_Mapping".
 *
 * The followings are the available columns in table 'Recipe_Ingredient_Quantity_Mapping':
 * @property integer $id
 * @property integer $recipe_id
 * @property integer $ingredient_id
 * @property integer $quantity
 * @property integer $measurement_id
 */
class RecipeIngredientQuantityMapping extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Recipe_Ingredient_Quantity_Mapping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('recipe_id, ingredient_id, quantity, measurement_id', 'required'),
			array('recipe_id, ingredient_id, quantity, measurement_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, recipe_id, ingredient_id, quantity, measurement_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'recipe_id' => 'Recipe',
			'ingredient_id' => 'Ingredient',
			'quantity' => 'Quantity',
			'measurement_id' => 'Measurement',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('recipe_id',$this->recipe_id);
		$criteria->compare('ingredient_id',$this->ingredient_id);
		$criteria->compare('quantity',$this->quantity);
		$criteria->compare('measurement_id',$this->measurement_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RecipeIngredientQuantityMapping the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
