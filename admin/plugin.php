<?php
class pluginAdmin extends Plugin {
	
    public function init()
	{
		$this->dbFields = array(
			'label'=>'Admin',
			'linktext'=>'Admin Panel',
            'enable' => false
		);
	}

	public function form()
	{
		global $L;

		$html  = '<div class="alert alert-primary" role="alert">';
		$html .= $this->description();
		$html .= '</div>';

		$html .= '<div>';
		$html .= '<label>'.$L->get('Label').'</label>';
		$html .= '<input name="label" type="text" value="'.$this->getValue('label').'">';
		$html .= '<span class="tip">'.$L->get('This title is almost always used in the sidebar of the site').'</span>';
		$html .= '</div>';

        $html .= '<div>';
		$html .= '<label>'.$L->get('Link Text to Admin Panel').'</label>';
		$html .= '<input name="linktext" type="text" value="'.$this->getValue('linktext').'">';
		$html .= '<span class="tip">'.$L->get('This is the text that will appear in the sidebar of the site linking to the admin panel.').'</span>';
		$html .= '</div>';
        
        $html .= '<div>';
		$html .= '<label>'.$L->get('Open Admin Panel in New Tab').'</label>';
		$html .= '<select name="enable">';
		$html .= '<option value="true" '.($this->getValue('enable')?'selected':'').'>'.$L->get('Enabled').'</option>';
		$html .= '<option value="false" '.(!$this->getValue('enable')?'selected':'').'>'.$L->get('Disabled').'</option>';
		$html .= '</select>';
		$html .= '</div>';
        
		return $html;
	}

	public function siteSidebar()
	{
		$target = '';
        if($this->getValue('enable')) {
            $target = ' target="_blank"';
        }
        $ltext = '<a href="'.HTML_PATH_ADMIN_ROOT.'"'.$target.'>'.$this->getValue('linktext').'</a>';
        $logged = new Login;
        if($logged->isLogged()){
            $idtext = 'Logged-in as <b>' . ucfirst($logged->username()) . '</b>';
        } else {
            $idtext = 'You are <b>NOT</b> logged-in';
        }

        $html  = '<div class="plugin plugin-admin">';
		$html .= '<h2 class="plugin-label">'.$this->getValue('label').'</h2>';
		$html .= '<div class="plugin-content">';
        $html .= $idtext.'<br />';
        $html .= $ltext;
 		$html .= '</div>';
 		$html .= '</div><br />';

		return $html;
	}    
}
