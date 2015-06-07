<?php
/*******************************************************************************
 *                      PQuery - PHP wrapper for JQuery.
 *******************************************************************************
 *      Author:     Vikas Patial
 *      Email:      email@ngcoders.com
 *      Website:    http://www.ngcoders.com
 *
 *      File:       pquery.php
 *      Version:    0.2
 *      Copyright:  (c) 2007 - Vikas Patial
 *                  You are free to use, distribute, and modify this software 
 *                  under the terms of the GNU General Public License.  See the
 *                  included license.txt file.
 *      
 *******************************************************************************
 *  VERION HISTORY:
 *
 *      v0.2 [05.15.2007] - Fixed some hacks which are no longer required , 
 *                            upgraded to JQuery 1.2.1 . 
 *
 *      v0.1 [02.12.2007] - Initial Version
 *
 *******************************************************************************
*/

class JQuery  {
	
		var $CALLBACKS 	=  	array('beforeSend',
							'complete',
							'error',
							'success');
		var $CONSTANTS =    array('hide','show','toggle');
		
		
		var $_radoms_list=array(); // just in case
		
		// after,append,appendTo,before,insertAfter,insertBefore,prepend,prependTo
				

	function form_remote_tag($options)
	{
		$options['form'] = true;
		if(!array_key_exists('id',$options))
		  $options['id'] = 'id_form';

		$uid=(isset($options['id']))?$options['id']:$this->_random_id();
		$id_string = 'id="'.$uid.'"';
		
		return '<form name="'.$options['name'].'" id="'.$options['id'].'" action="'.$options['url'].'" onsubmit=\''.$this->remote_function($options).'; return false;\' method="'.(isset($options['type'])?$options['type']:'GET').'"  >';			

	}
	
	function form_remote_tag_createme($options)
	{
		$options['form'] = true;
		if(!array_key_exists('id',$options))
		  $options['id'] = 'id_form';

		$uid=(isset($options['id']))?$options['id']:$this->_random_id();
		$id_string = 'id="'.$uid.'"';
		
		return '<form name="'.$options['name'].'" id="'.$options['id'].'" action="'.$options['url'].'" onsubmit=\''.$this->remote_function($options).'; return false;\' method="'.(isset($options['type'])?$options['type']:'GET').'"  >';			

	}
	
	function form_remote_tag2($options)
	{
		$options['form'] = true;
		if(!array_key_exists('id',$options))
		  $options['id'] = 'id_form';
		$uid=(isset($options['id']))?$options['id']:$this->_random_id();
		$id_string = 'id="'.$uid.'"';
		
		return '<form name="'.$options['name'].'" id="'.$options['id'].'" action="'.$options['url'].'" onsubmit=\''.$this->remote_function($options).'; return false;\' method="'.(isset($options['type'])?$options['type']:'GET').'"  >';			

	}
	
	function link_to_remote($name,$options=null,$html_options=null)
	{
		$html_options['id'] = isset($options['id'])?$options['id']:$this->_random_id();
		return $this->link_to_function($name,$this->remote_function($options),$html_options);
	}
	
	function remote_function($options)
	{
	
		$javascript_options = $this->_options_for_ajax($options);
		
		$ajax_function= '$.ajax({'.$javascript_options.'})';
		
		$ajax_function=(isset($options['before']))?  $options['before'].';'.$ajax_function : $ajax_function;
		$ajax_function=(isset($options['after']))?  $ajax_function.';'.$options['after'] : $ajax_function;
		$ajax_function=(isset($options['condition']))? 'if ('.$options['condition'].') {'.$ajax_function.'}' : $ajax_function;
		$ajax_function=(isset($options['confirm'])) ? 'if ( confirm(\''.$options['confirm'].'\' ) ) { '.$ajax_function.' } ':$ajax_function;
		
		return $ajax_function;
	
	}
	
	function visual_effect($name,$element,$options=null) {

		$effect='';
		$speed    = isset($options['speed'])?(is_numeric($options['speed'])?$options['speed']:'"'.$options['speed'].'"'):'"normal"';
		$callback = (isset($options['callback']))?',function(){'.$options['callback'].'})':')';
		
		switch($name) {
			case 'animate'	:
				$params = $this->_options_for_javascript($options,array('hide','show','toggle'));
				$effect ='$("'.$element.'").animate({'.$params.'},'.$speed.','.(isset($options['easing'])?'"'.$options['easing'].'"':'"linear"').$callback;
				break;
			case 'fadeIn':
			case 'fadeOut':
			case 'hide':
			case 'show':
			case 'slideDown':
			case 'slideToggle':
			case 'slideUp':
				$effect = '$("'.$element.'").'.$name.'('.$speed.$callback;
				break;
			case 'hide':
			case 'show':
			case 'toggle':
				$effect = '$("'.$element.'").'.$name.'()';
				break;
			case 'fadeTo':
				$effect = '$("'.$element.'").fadeTo('.$speed.','.$options['opacity'].$callback;
				break;
		}
		return $effect;
	
	}
	
	function show($id)
	{
		return $this->visual_effect('show',$id);
	}

	function toggle($id)
	{
		return $this->visual_effect('toggle',$id);
	}
	
	function hide($id)
	{
		return $this->visual_effect('hide',$id);
	}

	
	function ID($id,$extend=null)
	{
		return '$("'.$id.'")'.(!empty($extend))?'.'.$extend:'';
	}
	
	function call($function , $args = null)
	{
		$arg_str='';
		if (is_array($args)) {
			foreach ($args as $arg){
				if(!empty($arg_str))$arg_str.=', ';
				if( is_string($arg)) {
					$arg_str.="'$arg'";
				} else {
					$arg_str.=$arg;
				}
			}
		} else {
			if (is_string($args)) {
				$arg_str.="'$args'";
			} else {
				$arg_str.=$args;
			}
		}

		return "$function($arg_str)";
	}
	
	function alert($message)
	{
		return $this->call('alert',$message);
	}

	function assign($variable,$value)
	{
		return "$variable = $value;";
	}
	
	function delay($seconds=1,$script='')
	{
		return "setTimeout( function() { $script } , ".($seconds*1000)." )";
	}
	
	function redirect_to($location)
	{
		return $this->assign('window.location.href',$location);
	}
	
	function periodically_call_remote($options=null) {
		
		$frequency=(isset($options['frequency']))?$options['frequency']:10;
		$code = 'setInterval(function() { '.$this->remote_function($options).' },'.($frequency*1000).')';
		return $code;
		
	}
	
	function observe_field($field_id,$options=null)
	{
		if (isset($options['frequency']) && $options['frequency']> 0 ) {
			return $this->_build_observer(false,$field_id,$options);
		} else {
			return $this->_build_observer(true,$field_id,$options);
		}
	}
	
	// after,append,appendTo,before,insertAfter,insertBefore,prepend,prependTo
	
	function insert_html($position,$id,$html,$type='html')
	{
		$html_val= (($type=='html')?'"'.$html.'"':$html);
		return '$("'.$id.'").'.$position.'('.$html_val.')';
	}
	
	function replace_html($id,$html,$type='html')
	{
		$html_val= (($type=='html')?'"'.$html.'"':$html);
		return '$("'.$id.'").replace('.$html_val.')';
	}
	
	function remove($id,$expr=false)
	{
		$expr = (($expr)?'"'.$expr.'"':'');
		return '$("'.$id.'").remove('.$expr.')';
	}
	
	function clean($id)
	{
		return '$("'.$id.'").empty()';
	}
		
	function button_to_function($name,$function=null)
	{
		return '<input type="button" value="'.$name.'" onclick="'.$function.'" />';
		
	}
	

	function escape($javascript)
	{
		$javascript=str_replace(array("\r\n","\n","\r"),array("\n"),$javascript);
		$javascript=addslashes($javascript);
		return $javascript;
		
	}
	
	
	function tag($content)
	{
		return "\n<script type=\"text/javascript\" defer=\"defer\">\n".$content."\n</script>\n"; 
	}
	
		
	function link_to_function($name,$function,$html_options=null)
	{
		$uid=(isset($html_options['id']))?$html_options['id']:$this->_random_id();
		$id_string = 'id="'.$uid.'"';
		return '<a href="'.((isset($html_options['href']))?$html_options['href']:'javascript:void(0);').'" onclick=\''.((isset($html_options['onclick']))?$html_options['onclick'].';':'').$function.'; return false;\'>'.$name.'</a>';

	}
	
	/////////////////////////////////////////////////////////////////////////////////////
	//                             Private functions 
	/////////////////////////////////////////////////////////////////////////////////////
	
	function _random_id()
	{
		
		$salt = "abchefghjkmnpqrstuvwxyz0123456789";
		srand((double)microtime()*1000000);
			
		while(1) {
			$i = 0;
			$makepass = '';
			while ($i <= 6) {
				$num = rand() % 33;
				$tmp = substr($salt, $num, 1);
				$makepass = $makepass . $tmp;
				$i++;
			}
			if(!in_array($makepass,$this->_radoms_list)){
				$this->_radoms_list[] = $makepass;
				return  $makepass;
			}
		}
	}	
	
	function _build_callbacks($options)
	{
		$callbacks=array();
		foreach ($options as $callback=>$code) {
			if (in_array($callback,$this->CALLBACKS)) {
							$callbacks[$callback]='function(response){'.$code.'}';
						}			
		}
		return $callbacks;
	}
	
	function _build_observer($event=false,$name,$options=null)
	{

		$callback = isset($options['function']) ? $options['function'] : $this->remote_function($options);
		$frequency=(isset($options['frequency']))?$options['frequency']:10;
		
		
		if ($event) {
			$javascript = '$("'.$name.'").bind("'.$options['event'].'",function(event) {'.$callback.'})';
				} else {
			$javascript = 'setInterval(function() { '.$callback.' },'.($frequency*1000).')';
		}

		return $javascript;
		
	}
	
	function _method_option_to_s($method)
	{
		return (strstr($method,"'"))?$method:"'$method'";
	}
	
	function _options_for_ajax($options)
	{
		if (isset($options['url'])) $js_options['url']    = '"'.$options['url'].'"';
		
		
		if (isset($options['form'])) {
			$js_options['data']='$(this.elements).serialize()';		
		}elseif (isset($options['parameters'])){
			$js_options['data']='$("'.$options['submit'].'").serialize()';
		}elseif (isset($options['with'])) {
			$js_options['data']= '"'.$options['with'].'"';
		}
		
		$html_update=(isset($options['position'])?$options['position']:'html');
		if (isset($options['update']))$options['success']='$("'.$options['update'].'").'.$html_update.'(response);'.(isset($options['success'])?$options['success']:'');
				
		$js_options=array_merge($js_options,(is_array($options))?$this->_build_callbacks($options):array());
		
		if (isset($options['async']))$js_options['async'] = $options['async'];

		if (isset($options['type'])) $js_options['type'] = '"'.$options['type'].'"';
		if (isset($options['contentType'])) $js_options['contentType'] = '"'.$options['contentType'].'"';
		
		$js_options['dataType'] = (isset($options['dataType']))?'"'.$options['dataType'].'"':'"html"';
		
		if (isset($options['timeout'])) $js_options['timeout'] = $options['timeout'];
		
		if (isset($options['processData'])) $js_options['processData'] = $options['processData'];
		if (isset($options['ifModified'])) $js_options['ifModified'] = $options['ifModified'];
		if (isset($options['global'])) $js_options['global'] = $options['global'];
			
		return $this->_options_for_javascript($js_options);
	}


	function _array_or_string_for_javascript($option)
	{
		$return_val='';
		if(is_array($option))
		{
			foreach ($option as $value) {
				if(!empty($return_val))$ret_val.=', ';
				$return_val.=$value;
			}
			return '['.$return_val.']';
		} 
			return "'$option'";	
	}
	
	
	function _options_for_javascript($options,$constants=false)
	{
		$return_val='';
		
		if (is_array($options)) {
			
		foreach ($options as $var=>$val)
		{
			if (!empty($return_val)) $return_val.=', ';
			if(!$constants)$return_val.="$var: $val";
			else  {
				$return_val.= $var.' : '.((in_array($val,$constants))?'"'.$val.'"':$val);
			}
		}
		}		
		return $return_val;
	}
	
}

class PQuery extends JQuery{
}

?>
