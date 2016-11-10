<?php 

/**
* 
esta es una clase para declarar el logo doble, en el navbar-fixed-top

*/
class logoHeader{

    private $logo_large;
    private $logo_small;
    private $error;
    private $class;

    function __construct($logo_large, $logo_small, $error){

    	$this->setLogos($logo_large, $logo_small);
		$this->setError($error);
        $this->render();
    }

    function render(){
    	if ($this->logo_large!='' && $this->logo_small!='') {
    		$this->renderLogoLarge('logo-large');
    		$this->renderLogoSmall('logo-small hidden');
		}else{
			if ($this->logo_large!='' || $this->logo_small!='') {
				if ($this->logo_large!='') {
					$this->renderLogoLarge('logo-large');
    				$this->renderLogoLarge('logo-small hidden');
				}
				if ($this->logo_small!='') {
					$this->renderLogoSmall('logo-large');
    				$this->renderLogoSmall('logo-small hidden');
				}
			}else{
				$this->renderError();
			}
		}
    }

    function setLogos($logo_large, $logo_small){
    	$this->logo_large = $logo_large;
    	$this->logo_small = $logo_small;
    }

    function setError($error){
    	return $this->error = $error;
    }

    function renderLogoLarge($class){
    	printf('<a href="%s">
				<img src="%s" alt="main-logo" class="logo %s">
			</a>', home_url(), $this->logo_large, $class);
    }

    function renderLogoSmall($class){
    	printf('<a href="%s">
				<img src="%s" alt="main-logo" class="logo %s hidden">
			</a>', home_url(), $this->logo_small, $class);
    }

    function renderError(){
    	printf('<a href="%s">
					<h3 class="text-danger">%s</h3>
				</a>', home_url('wp-admin/admin.php?page=screen_options'), $this->error);
    } 
}