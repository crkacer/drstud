<?php
App::uses('AppModel', 'Model');
App::uses('CakeSession', 'Model/Datasource');

class Cart extends AppModel {

	public $useTable = false; 
	
	/*
	 * add a product to cart
	 */
	public function addPackage($productId) {
		$this->savePackage(array());
		$allPackages = $this->readPackage();
		
		if (null!=$allPackages) {
		//	if (array_key_exists($productId, $allPackages)) {
		//		$allPackages[$productId]++;
		//	} else {
		//		$allPackages[$productId] = 1;
		//	}
		//} else {
		//	$allPackages[$productId] = 1;
		//}
		if (array_key_exists($productId, $allPackages)) {
				//$allPackages[$productId]++;
			} else {
				$allPackages[$productId] = 1;
			}
		} else {
			$allPackages[$productId] = 1;
		}
		
		$this->savePackage($allPackages);
	}
	
	/*
	 * get total count of products
	 */
	public function getCount() {
		$allPackages = $this->readPackage();
		
		if (count($allPackages)<1) {
			return 0;
		}
		
		$count = 0;
		foreach ($allPackages as $product) {
			$count=$count+$product;
		}
		
		return $count;
	}

	/*
	 * save data to session
	 */
	public function savePackage($data) {
		return CakeSession::write('cart',$data);
	}

	/*
	 * read cart data from session
	 */
	public function readPackage() {
		return CakeSession::read('cart');
	}

}