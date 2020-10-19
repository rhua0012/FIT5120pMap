<?php
class shapeModelGmp extends modelGmp {
	public static $tableObj;
	function __construct() {
		$this->_setTbl('shape');
		if(empty(self::$tableObj)){
			self::$tableObj = frameGmp::_()->getTable('shape');
		}
	}
	public function save($shape = array(), &$update = false) {
		$id = isset($shape['id']) ? (int) $shape['id'] : 0;
		$shape['title'] = isset($shape['title']) ? trim($shape['title']) : '';
		$update = (bool) $id;
		if(!empty($shape['title'])) {
			$shape['map_id'] = isset($shape['map_id']) ? (int) $shape['map_id'] : 0;
			if(!$update) {
				// We use timestamp field type in db
				//$shape['create_date'] = date('Y-m-d H:i:s');
				if($shape['map_id']) {
					$maxSortOrder = (int) dbGmp::get('SELECT MAX(sort_order) FROM @__shapes WHERE map_id = "'. $shape['map_id']. '"', 'one');
					$shape['sort_order'] = ++$maxSortOrder;
				}
			}
			$shape['coords'] = isset($shape['coords']) ? base64_encode(utilsGmp::serialize($shape['coords'])) : '';
			$shape['params'] = isset($shape['params']) ? utilsGmp::serialize($shape['params']) : '';
			if($update) {
				//dispatcherGmp::doAction('beforeShapeUpdate', $id, $shape);
				$dbRes = frameGmp::_()->getTable('shape')->update($shape, array('id' => $id));
				//dispatcherGmp::doAction('afterShapeUpdate', $id, $shape);
			} else {
				//dispatcherGmp::doAction('beforeShapeInsert', $shape);
				$dbRes = frameGmp::_()->getTable('shape')->insert($shape);
				//dispatcherGmp::doAction('afterShapeInsert', $dbRes, $shape);
			}
			if($dbRes) {
				if(!$update)
					$id = $dbRes;
				return $id;
			} else {
				$this->pushError(frameGmp::_()->getTable('shape')->getErrors());
			}
		} else {
			$this->pushError(__('Please enter figure name'), 'shape_opts[title]', GMP_LANG_CODE);
		}
		return false;
	}
	public function getById($id) {
		return $this->_afterGet(frameGmp::_()->getTable('shape')->get('*', array('id' => $id), '', 'row'));
	}
	public function getShapeByTitle($title) {
		return $this->_afterGet(frameGmp::_()->getTable('shape')->get('*', array('title' => $title), '', 'row'));
	}
	public function _afterGet($shape, $widthMapData = false, $withoutIcons = false) {
		if(!empty($shape)) {
			$shape['coords'] = @unserialize($shape['coords']) ? $shape['coords'] : base64_decode($shape['coords']);
			$shape['coords'] = utilsGmp::unserialize($shape['coords']);
			$shape['params'] = utilsGmp::unserialize($shape['params']);
			// Go to absolute path as "../wp-content/" will not work on frontend
			//$shape['description'] = str_replace('../wp-content/', GMP_SITE_URL. 'wp-content/', $shape['description']);
			/*if(uriGmp::isHttps()) {
				$shape['description'] = uriGmp::makeHttps($shape['description']);
			}*/
			if($widthMapData && !empty($shape['map_id']))
				$shape['map'] = frameGmp::_()->getModule('gmap')->getModel()->getMapById($shape['map_id'], false);
			$shape['actions'] = frameGmp::_()->getModule('shape')->getView()->getListOperations($shape['id']);
		}
		return $shape;
	}
	public function getMapShapes($mapId) {
		$mapId = (int) $mapId;
		$shapes = frameGmp::_()->getTable('shape')->orderBy('sort_order ASC')->get('*', array('map_id' => $mapId));
		if(!empty($shapes)) {
			foreach($shapes as $i => $m) {
				$shapes[$i] = $this->_afterGet($shapes[$i], false, true);
			}
		}
		return $shapes;
	}
	public function getMapShapesIds($mapId) {
		return frameGmp::_()->getTable('shape')->get('id', array('map_id' => $mapId), '', 'col');
	}
	public function getShapesByIds($ids) {
		if(!is_array($ids))
			$ids = array( $ids );
		$ids = array_map('intval', $ids);
		$shapes = frameGmp::_()->getTable('shape')->get('*', array('additionalCondition' => 'id IN ('. implode(',', $ids). ')'));
		if(!empty($shapes)) {
			foreach($shapes as $i => $m) {
				$shapes[$i] = $this->_afterGet($shapes[$i]);
			}
		}
		return $shapes;
	}
	public function removeShape($shapeId){
		//dispatcherGmp::doAction('beforeShapeRemove', $shapeId);
		return frameGmp::_()->getTable('shape')->delete(array('id' => $shapeId));
	}
	public function removeList($ids) {
		$ids = array_map('intval', $ids);
		return frameGmp::_()->getTable('shape')->delete(array('additionalCondition' => 'id IN ('. implode(',', $ids). ')'));
	}
	public function findAddress($params){
		if(!isset($params['addressStr']) || strlen($params['addressStr']) < 3){
			$this->pushError(__('Address is empty or not match', GMP_LANG_CODE));
			return false;
		}
		$addr = $params['addressStr'];
		$getdata = http_build_query(
			array(
				'address' => $addr,
				'language' => 'en',
				'sensor'=>'false',
			)
		);
		$apiDomain = frameGmp::_()->getModule('gmap')->getView()->getApiDomain();
		$google_response = utilsGmp::jsonDecode(file_get_contents($apiDomain . 'maps/api/geocode/json?'. $getdata));
		$res = array();
		foreach($google_response['results'] as $response) {
			$res[] = array(
				'position'  =>  $response['geometry']['location'],
				'address'   =>  $response['formatted_address'],
			);
		}
		return $res;
	}
	public function removeShapesFromMap($mapId){
		return frameGmp::_()->getTable('shape')->delete("`map_id`='".$mapId."'");
	}
	public function getAllShapes($d = array(), $widthMapData = false) {
		if(isset($d['limitFrom']) && isset($d['limitTo']))
			frameGmp::_()->getTable('shape')->limitFrom($d['limitFrom'])->limitTo($d['limitTo']);
		if(isset($d['orderBy']) && !empty($d['orderBy'])) {
			frameGmp::_()->getTable('shape')->orderBy( $d['orderBy'] );
		}
		$shapeList = frameGmp::_()->getTable('shape')->get('*', $d);
		foreach($shapeList as $i => &$m) {
			$shapeList[$i] = $this->_afterGet($shapeList[$i], $widthMapData);
		}
		return $shapeList;
	}
	public function setShapesToMap($addShapeIds, $mapId) {
		if(!is_array($addShapeIds))
			$addShapeIds = array($addShapeIds);
		$addShapeIds = array_map('intval', $addShapeIds);
		return frameGmp::_()->getTable('shape')->update(array('map_id' => (int)$mapId), array('additionalCondition' => 'id IN ('. implode(',', $addShapeIds). ')'));
	}
	public function getCount($d = array()) {
		return frameGmp::_()->getTable('shape')->get('COUNT(*)', $d, '', 'one');
	}
	public function updatePos($d = array()) {
		$d['id'] = isset($d['id']) ? (int) $d['id'] : 0;
		if($d['id']) {
			return frameGmp::_()->getTable('shape')->update(array(
				'coords' => base64_encode(utilsGmp::serialize($d['coords']))
			), array(
				'id' => $d['id'],
			));
		} else
			$this->pushError (__('Invalid Figure ID'));
		return false;
	}
	public function existsId($id){
		if($id){
			$figure = frameGmp::_()->getTable('shape')->get('*', array('id' => $id), '', 'row');
			if(!empty($figure)){
				return true;
			}
		}
		return false;
	}
}