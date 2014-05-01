<?php

/**
 * This is the model class for table "items".
 *
 * The followings are the available columns in table 'items':
 * @property integer $id
 * @property integer $album_cover_item_id
 * @property integer $captured
 * @property integer $created
 * @property string $description
 * @property integer $height
 * @property integer $left_ptr
 * @property integer $level
 * @property string $mime_type
 * @property string $name
 * @property integer $owner_id
 * @property integer $parent_id
 * @property string $rand_key
 * @property string $relative_path_cache
 * @property string $relative_url_cache
 * @property integer $resize_dirty
 * @property integer $resize_height
 * @property integer $resize_width
 * @property integer $right_ptr
 * @property string $slug
 * @property string $sort_column
 * @property string $sort_order
 * @property integer $thumb_dirty
 * @property integer $thumb_height
 * @property integer $thumb_width
 * @property string $title
 * @property string $type
 * @property integer $updated
 * @property integer $view_count
 * @property integer $weight
 * @property integer $width
 * @property string $view_1
 * @property string $view_2
 * @property string $view_3
 */
class FlitcieItem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('left_ptr, level, parent_id, right_ptr, type', 'required'),
			array('album_cover_item_id, captured, created, height, left_ptr, level, owner_id, parent_id, resize_dirty, resize_height, resize_width, right_ptr, thumb_dirty, thumb_height, thumb_width, updated, view_count, weight, width', 'numerical', 'integerOnly'=>true),
			array('mime_type, sort_column', 'length', 'max'=>64),
			array('name, relative_path_cache, relative_url_cache, slug, title', 'length', 'max'=>255),
			array('rand_key', 'length', 'max'=>11),
			array('sort_order', 'length', 'max'=>4),
			array('type', 'length', 'max'=>32),
			array('view_1, view_2, view_3', 'length', 'max'=>1),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, album_cover_item_id, captured, created, description, height, left_ptr, level, mime_type, name, owner_id, parent_id, rand_key, relative_path_cache, relative_url_cache, resize_dirty, resize_height, resize_width, right_ptr, slug, sort_column, sort_order, thumb_dirty, thumb_height, thumb_width, title, type, updated, view_count, weight, width, view_1, view_2, view_3', 'safe', 'on'=>'search'),
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
			'album_cover_item_id' => 'Album Cover Item',
			'captured' => 'Captured',
			'created' => 'Created',
			'description' => 'Description',
			'height' => 'Height',
			'left_ptr' => 'Left Ptr',
			'level' => 'Level',
			'mime_type' => 'Mime Type',
			'name' => 'Name',
			'owner_id' => 'Owner',
			'parent_id' => 'Parent',
			'rand_key' => 'Rand Key',
			'relative_path_cache' => 'Relative Path Cache',
			'relative_url_cache' => 'Relative Url Cache',
			'resize_dirty' => 'Resize Dirty',
			'resize_height' => 'Resize Height',
			'resize_width' => 'Resize Width',
			'right_ptr' => 'Right Ptr',
			'slug' => 'Slug',
			'sort_column' => 'Sort Column',
			'sort_order' => 'Sort Order',
			'thumb_dirty' => 'Thumb Dirty',
			'thumb_height' => 'Thumb Height',
			'thumb_width' => 'Thumb Width',
			'title' => 'Title',
			'type' => 'Type',
			'updated' => 'Updated',
			'view_count' => 'View Count',
			'weight' => 'Weight',
			'width' => 'Width',
			'view_1' => 'View 1',
			'view_2' => 'View 2',
			'view_3' => 'View 3',
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
		$criteria->compare('album_cover_item_id',$this->album_cover_item_id);
		$criteria->compare('captured',$this->captured);
		$criteria->compare('created',$this->created);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('height',$this->height);
		$criteria->compare('left_ptr',$this->left_ptr);
		$criteria->compare('level',$this->level);
		$criteria->compare('mime_type',$this->mime_type,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('owner_id',$this->owner_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('rand_key',$this->rand_key,true);
		$criteria->compare('relative_path_cache',$this->relative_path_cache,true);
		$criteria->compare('relative_url_cache',$this->relative_url_cache,true);
		$criteria->compare('resize_dirty',$this->resize_dirty);
		$criteria->compare('resize_height',$this->resize_height);
		$criteria->compare('resize_width',$this->resize_width);
		$criteria->compare('right_ptr',$this->right_ptr);
		$criteria->compare('slug',$this->slug,true);
		$criteria->compare('sort_column',$this->sort_column,true);
		$criteria->compare('sort_order',$this->sort_order,true);
		$criteria->compare('thumb_dirty',$this->thumb_dirty);
		$criteria->compare('thumb_height',$this->thumb_height);
		$criteria->compare('thumb_width',$this->thumb_width);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('updated',$this->updated);
		$criteria->compare('view_count',$this->view_count);
		$criteria->compare('weight',$this->weight);
		$criteria->compare('width',$this->width);
		$criteria->compare('view_1',$this->view_1,true);
		$criteria->compare('view_2',$this->view_2,true);
		$criteria->compare('view_3',$this->view_3,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return CDbConnection the database connection used for this class
	 */
	public function getDbConnection()
	{
		return Yii::app()->dbFlitcie;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FlitcieItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
