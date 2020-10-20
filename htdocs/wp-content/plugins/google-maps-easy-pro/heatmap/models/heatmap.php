<?php
class heatmapModelGmp extends modelGmp {
	public static $tableObj;
	function __construct() {
		$this->_setTbl('heatmap');
		if(empty(self::$tableObj)){
			self::$tableObj = frameGmp::_()->getTable('heatmap');
		}
	}
	public function save($heatmap = array(), &$update = false) {
		$id = isset($heatmap['id']) ? (int) $heatmap['id'] : 0;
		$update = (bool) $id;
		$heatmap['map_id'] = isset($heatmap['map_id']) ? (int) $heatmap['map_id'] : 0;
		$heatmap['coords'] = isset($heatmap['coords']) ? base64_encode(utilsGmp::serialize($heatmap['coords'])) : '';

		//it's important to set default params if user not chose color
		if($heatmap['params']['gradient'][0] === ''){
			$heatmap['params']['gradient'][0] = 'rgba(94, 216, 54, 0)';
			$heatmap['params']['gradient'][1] = '#00f71c';
		}

		$heatmap['params'] = isset($heatmap['params']) ? utilsGmp::serialize($heatmap['params']) : '';

		if($update) {
			//dispatcherGmp::doAction('beforeHeatmapUpdate', $id, $heatmap);
			$dbRes = frameGmp::_()->getTable('heatmap')->update($heatmap, array('id' => $id));
			//dispatcherGmp::doAction('afterHeatmapUpdate', $id, $heatmap);
		} else {
			//dispatcherGmp::doAction('beforeHeatmapInsert', $heatmap);
			$dbRes = frameGmp::_()->getTable('heatmap')->insert($heatmap);
			//dispatcherGmp::doAction('afterHeatmapInsert', $dbRes, $heatmap);
		}
		if($dbRes) {
			if(!$update)
				$id = $dbRes;
			return $id;
		} else {
			$this->pushError(frameGmp::_()->getTable('heatmap')->getErrors());
		}
		return false;
	}
	public function getAllHeatmap($d = array(), $widthMapData = false) {
		if(isset($d['limitFrom']) && isset($d['limitTo']))
			frameGmp::_()->getTable('heatmap')->limitFrom($d['limitFrom'])->limitTo($d['limitTo']);
		if(isset($d['orderBy']) && !empty($d['orderBy'])) {
			frameGmp::_()->getTable('heatmap')->orderBy( $d['orderBy'] );
		}
		$heatmapList = frameGmp::_()->getTable('heatmap')->get('*', $d);
		foreach($heatmapList as $i => &$m) {
			$heatmapList[$i] = $this->_afterGet($heatmapList[$i], $widthMapData);
		}
		return $heatmapList;
	}
	public function getById($id) {
		return $this->_afterGet(frameGmp::_()->getTable('heatmap')->get('*', array('id' => $id), '', 'row'));
	}
	public function getByMapId($map_id) {
		return $this->_afterGet(frameGmp::_()->getTable('heatmap')->get('*', array('map_id' => $map_id), '', 'row'));
	}
	public function _afterGet($heatmap, $widthMapData = false) {
		if(!empty($heatmap)) {
			$heatmap['coords'] = utilsGmp::unserialize(base64_decode($heatmap['coords']));
			$heatmap['params'] = utilsGmp::unserialize($heatmap['params']);
			if($widthMapData && !empty($heatmap['map_id']))
				$heatmap['map'] = frameGmp::_()->getModule('gmap')->getModel()->getMapById($heatmap['map_id'], false);
		}
		return $heatmap;
	}
	public function removeHeatmap($heatmapId){
		//dispatcherGmp::doAction('beforeHeatmapRemove', $heatmapId);
		return frameGmp::_()->getTable('heatmap')->delete(array('id' => $heatmapId));
	}
	public function existsId($id){
		if($id){
			$heatmap = frameGmp::_()->getTable('heatmap')->get('*', array('id' => $id), '', 'row');
			if(!empty($heatmap)){
				return true;
			}
		}
		return false;
	}
}