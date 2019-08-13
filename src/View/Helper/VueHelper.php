<?
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;
use Cake\View\Helper\HtmlHelper;

class VueHelper extends HtmlHelper
{
    public function component($name, $props = []){
      return $this->tag('component-loader', '', ['name' => $name, 'props' => json_encode($props)]);
    }
}
