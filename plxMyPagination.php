<?php
/**
 *
 * Plugin	staticPagination
 * @author	Gérald Niel
 ° @version	1.0
 * @date	26/10/2015 
 **/
class plxMyPagination extends plxPlugin {

	/**
	 * Constructeur de la classe
	 *
	 * @param	default_lang	langue par défaut
	 * @return	stdio
	 * @author	Gérald Niel
	 **/
	public function __construct($default_lang) {

		// appel du constructeur de la classe plxPlugin (obligatoire)
		parent::__construct($default_lang);

		// droits pour accèder à la page config.php du plugin
		$this->setConfigProfil(PROFIL_ADMIN);
		
		$this->addHook('staticPagination', 'staticPagination');
		$this->addHook('plxShowPagination', 'plxShowPagination');
	}

	/**
	 * Méthode de traitement du hook plxShowPagination
	 * Adaptation de la fonction du plugin plxMyPager de Stephane F
	 *
	 * @return	stdio
	 * @author	Gérald Niel
	 **/
	public function plxShowPagination() {

		$string = '

		$nbpage = ceil($plxGlob_arts->count/$this->plxMotor->bypage);
		$plxPlugin = $this->plxMotor->plxPlugins->getInstance("plxMyPagination");

		if($arg_url!="")
			$arg_url = trim($arg_url, "/")."/";
			
		$nbdisp	= $plxPlugin->getParam("nbdisp");
		$nbdisp = $nbdisp < 3 ? 3 : $nbdisp;
		$stop = $this->plxMotor->page + round($nbdisp/2) - 1;
		if($stop<$nbdisp) $stop=$nbdisp;
		if($stop>$nbpage) $stop=$nbpage;
		
		$start = $stop - $nbdisp + 1;
		if($start<1) $start=1;

		echo "\t\t<ul class=\"pagination\">\n";
		
		if($plxPlugin->getParam("elmt1")) {
			if($this->plxMotor->page>2) {
				echo "\t\t\t<li><a class=\"pagenav p_first\" href=\"".$f_url."\" title=\"".L_PAGINATION_FIRST_TITLE."\"><i class=\"fa fa-fast-backward\"></i><span class=\"hide\">".L_PAGINATION_FIRST."</span></a></li>\n";
			} else {
				echo "\t\t\t<li><span class=\"pagenav p_first\"><i class=\"fa fa-fast-backward\"></i><span class=\"hide\">".L_PAGINATION_FIRST."</span></span></li>\n";
			}
		}

		if($plxPlugin->getParam("elmt2")) {
			if ($this->plxMotor->page>1) {
				echo "\t\t\t<li><a class=\"pagenav p_prev\" href=\"".$p_url."\" title=\"".L_PAGINATION_PREVIOUS_TITLE."\" rel=\"prev\"><i class=\"fa fa-step-backward\"></i><span class=\"hide\">".L_PAGINATION_PREVIOUS."</span></a></li>\n";
			} else {
				echo "\t\t\t<li><span class=\"pagenav p_prev\"><i class=\"fa fa-step-backward\"></i><span class=\"hide\">".L_PAGINATION_PREVIOUS."</span></span></li>\n";
			}
		}

		if($plxPlugin->getParam("elmt3") AND $plxPlugin->getParam("elmt6") AND $start>1)
			echo "\t\t\t<li><span class=\"pagenav\">…</span></li>\n";

		for($i=$start;$i<=$stop;$i++) {
			$url = $this->plxMotor->urlRewrite("?".$arg_url.($i<=1?"":"page".$i));
			if($i==$this->plxMotor->page) {
				echo "\t\t\t<li><span class=\"pagenav p_current\">".$i."</span></li>\n";
			} else {
				if($plxPlugin->getParam("elmt6")) echo "\t\t\t<li><a class=\"pagenav\" href=\"".$url."\" title=\"Page ".$i."\">".$i."</a></li>\n";
			}
		}

		if($plxPlugin->getParam("elmt3") AND $plxPlugin->getParam("elmt6") AND ($this->plxMotor->page+round($nbdisp/2)-1)<$nbpage AND $stop<$nbpage)
			echo "\t\t\t<li><span class=\"pagenav\">…</span></li>\n";

		if($plxPlugin->getParam("elmt4")) {
			if($this->plxMotor->page<$nbpage) {
				echo "\t\t\t<li><a class=\"pagenav p_next\" href=\"".$n_url."\" title=\"".L_PAGINATION_NEXT_TITLE."\" rel=\"next\"><span class=\"hide\">".L_PAGINATION_NEXT."</span><i class=\"fa fa-step-forward\"></i></a></li>\n";
			} else {
				echo "\t\t\t<li><span class=\"pagenav p_next\"><span class=\"hide\">".L_PAGINATION_NEXT."</span><i class=\"fa fa-step-forward\"></i></span></li>\n";
			}
		}
		
		if($plxPlugin->getParam("elmt5")) {
			if($this->plxMotor->page<$nbpage-1) {
				echo "\t\t\t<li><a class=\"pagenav p_last\" href=\"".$l_url."\" title=\"".L_PAGINATION_LAST_TITLE."\"><span class=\"hide\">".L_PAGINATION_LAST."</span><i class=\"fa fa-fast-forward\"></i></a></li>\n";
			} else {
				echo "\t\t\t<li><span class=\"pagenav p_last\"><span class=\"hide\">".L_PAGINATION_LAST."</span><i class=\"fa fa-fast-forward\"></i></span></li>\n";
			}
		}

		echo "\t\t</ul>\n";

		if($plxPlugin->getParam("elmt0"))
			echo "\t\t<p class=\"p_pager\">Page ".$this->plxMotor->page." sur ".$nbpage."</p>\n";

		return true;
		';
		echo "<?php ".$string." ?>";

	}

	/**
	 * Méthode de traitement du hook staticPagination
	 *
	 * @return	stdio
	 * @author	Gérald Niel
	 **/
	 public function  staticPagination() {
	 	$string = '
		$pages = Array();
		$id = $plxShow->plxMotor->cible;
		$page_grp = trim($plxShow->plxMotor->aStats[$id]["group"]);
	
		if ($page_grp) {

			$elmt0 	= '.$this->getParam("elmt0").';
			$elmt1	= '.$this->getParam("elmt1").';
			$elmt2	= '.$this->getParam("elmt2").';
			$elmt3	= '.$this->getParam("elmt3").';
			$elmt4	= '.$this->getParam("elmt4").';
			$elmt5	= '.$this->getParam("elmt5").';
			$elmt6	= '.$this->getParam("elmt6").';
			$nbdisp	= '.$this->getParam("nbdisp").' - 1;
			$nbdisp = $nbdisp < 2 ? 3 : $nbdisp; 
			echo "<div id=\"pagination\" role=\"navigation\">\n"; 
			echo "\t\t<ul class=\"pagination\">\n";
		
			$static_pages = $plxShow->plxMotor->aStats;
			foreach($static_pages as $k=>$v) {
				if($v["active"] == 1 and trim($v["group"]) == $page_grp) {
					$url_p = $plxMotor->urlRewrite("?static".$k."/".$v["url"]);
					array_push($pages,  ["id"=>$k, "url"=>$url_p, "name"=>$v["name"]]);
				}
			}
			$nbpage = count($pages);
		
			if ($nbpage > 1) {
		
				$last = $nbpage - 1;
				$str_elmt3 = "\t\t\t\t<li><span class=\"pagenav\">…</span></li>\n";
				foreach($pages as $k=>$v) {
					if ($v["id"] == $id) {
						$nopage = $k + 1;
						$current_p = "\t\t\t\t<li><span class=\"pagenav p_current\">".$nopage."</span></li>\n";
						$stop = $k + round($nbdisp/2);
						if( $stop < $nbdisp ) $stop = $nbdisp;
						if( $stop > $last ) $stop = $last;
						$start = $stop - $nbdisp;
						if($start < 0 ) $start = 0;
						($k == 0) ? $prev = $last : $prev = $k - 1;
						($k == $last) ? $next = 0 : $next = $k + 1;
						if ( $elmt1 ) {
							if ( $nopage > 2 ) {
								echo "\t\t\t\t<li><a class=\"pagenav p_first\" href=\"".$pages[0]["url"]."\" title=\"".$pages[0]["name"]."\"><i class=\"fa fa-fast-backward\"></i><span class=\"hide\">".L_PAGINATION_FIRST."</span></a></li>\n";
							} else {
								echo "\t\t\t\t<li><span class=\"pagenav p_first\"><i class=\"fa fa-fast-backward\"></i><span class=\"hide\">".L_PAGINATION_FIRST."</span></span></li>\n";
							}
						}
						
						if ( $elmt2 ) {
							if ( $nopage > 1 ) {
								echo "\t\t\t\t<li><a rel=\"prev\" class=\"pagenav p_prev\" href=\"".$pages[$prev]["url"]."\" title=\"".$pages[$prev]["name"]."\"><i class=\"fa fa-step-backward\"></i><span class=\"hide\">".L_PAGINATION_PREVIOUS."</span></a></li>\n";
							} else {
								echo "\t\t\t\t<li><span class=\"pagenav p_prev\"><i class=\"fa fa-step-backward\"></i><span class=\"hide\">".L_PAGINATION_PREVIOUS."</span></span></li>\n";
							}
						}
						
						if ( $start > 0 and $elmt6 and $elmt3 ) echo $str_elmt3;

						if ($elmt6) {
							for( $i = $start; $i <= $stop; $i++ ) {
								($k == $i ) ? $html_str = $current_p : $html_str = "\t\t\t\t<li><a class=\"pagenav p_page\" href=\"".$pages[$i]["url"]."\" title=\"".$pages[$i]["name"]."\">".($i +1)."</a></li>\n";
								echo $html_str;
							}
						} else {
							echo $current_p;
						}
					
						if ( $k < $last and $stop < $last and $elmt6 and $elmt3 ) echo $str_elmt3;
					
						if ( $elmt4 ) {
							if ( $nopage < $nbpage ) {
								echo "\t\t\t\t<li><a rel=\"next\" class=\"pagenav p_next\" href=\"".$pages[$next]["url"]."\" title=\"".$pages[$next]["name"]."\"><span class=\"hide\">".L_PAGINATION_NEXT."</span><i class=\"fa fa-step-forward\"></i></a></li>\n";
							} else {
								echo "\t\t\t\t<li><span class=\"pagenav p_next\"><span class=\"hide\">".L_PAGINATION_NEXT."</span><i class=\"fa fa-step-forward\"></i></span></li>\n";
							}
						}
						
						if ( $elmt5 ) {
							if ( $nopage < $last ) {
								echo "\t\t\t\t<li><a class=\"pagenav p_last\" href=\"".$pages[$last]["url"]."\" title=\"".$pages[$last]["name"]."\"><span class=\"hide\">".L_PAGINATION_LAST."</span><i class=\"fa fa-fast-forward\"></i></a></li>\n";
							} else {
								echo "\t\t\t\t<li><span class=\"pagenav p_last\"><span class=\"hide\">".L_PAGINATION_LAST."</span><i class=\"fa fa-fast-forward\"></i></span></li>\n";
							}
						}
						
						echo "\t\t</ul>\n";
						if ($elmt0) echo "\t\t<p class=\"p_pager\">Page ".$nopage." sur ".$nbpage."</p>\n";
					}
				}
			} else {
				echo "\t\t\t\t<li><span class=\"pagenav p_current\">".$nbpage."</span></li>\n";
				echo "\t\t</ul>\n";
			}
			echo "\t</div>\n";
		}	 	
	 	';
	 	echo "<?php ".$string." ?>";
	 }
}
?>
