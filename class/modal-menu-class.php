<?php 

/**
* 
esta es una clase para generar un icon-menu con trigger modal en el navbar-fixed-top

*/
class modalMenu{

    private $items;
    private $menu;
    private $text;
    private $icon;
    private $link;
    private $error;

    function __construct($items, $error){

    	$this->setItems($items);
		$this->setError($error);
    }

    function render(){
    	if (count($this->items)>0) {
            ?>
                <ul class="col-md-9 top-menu wow-delay">
                    <?php 
                        for ($i=0; $i < count($this->items); $i++) { 
                            if ($this->items[$i]!=null) {
                                switch ($this->items[$i]['menu']) {
                                    case 'search':
                                        get_template_part('view/header/search');
                                        break;
                                    case 'lang':
                                        get_template_part('view/header/lang');
                                        break;
                                    case 'contact':
                                        get_template_part('view/header/contact');
                                        break;
                                    case 'link':
                                        get_template_part('view/header/link');
                                        break;
                                    case 'menu':
                                        get_template_part('view/header/menu');
                                        break;
                                    default:
                                        get_template_part('view/header/error');
                                        break;
                                }
                            }
                        }
                    ?>
                </ul>
            <?php
        }
    }

    function setItems($items){
    	$this->items = $items;
    }

    function setError($error){
    	return $this->error = $error;
    } 

    function renderSearch($item){
        $this->menu = $item['menu'];
        $this->text = $item['text'];
        $this->icon = $item['icon'];
        printf('<div class="form-search">
                    <a href="#" class="menu-link search-link">
                        <i class="fa %s"></i>
                    </a>
                </div>', $this->icon);
        printf('<div class="modal fade winsystems-modal" id="search-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content wow-delay">
                  <div class="modal-header fadeInLeft wow">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
                    <h4 class="modal-title" id="myModalLabel">%s</h4>
                  </div>
                  <div class="modal-body fadeInLeft wow">
                   <form action="$s" method="get" role="search" id="search_form">
                        <div class="input-group input-group-lg">
                            <input class="form-control" placeholder="Buscar..." value="" name="s" title="Buscar:" type="text">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" id="search_submit">
                                    <i class="%s"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>', $this->text, home_url(), $this->icon);
    }
    function searchScript(){
        echo "jQuery('.search-link').click(function(){
                    setTimeout(function(){
                        jQuery('#search-modal').modal();
                        jQuery('.modal').slideDown(1000);
                    }, 100);
                });";
    }
}