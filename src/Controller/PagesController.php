<?php
declare(strict_types=1);
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\View\Exception\MissingTemplateException;
use Cake\I18n\I18n;

class PagesController extends AppController
{
  public function view($slug)
  {
    $this->loadModel('Trois/Cms.Pages');

    $lng = I18n::getLocale();
    $slugField = $lng == 'fr_CH'? 'Pages.slug' : 'Pages_slug_translation.content';
    if(property_exists($this->Pages, 'setLocale')) $this->Pages->setLocale($lng);

    $page = $this->Pages->find()
    ->where([$slugField => $slug])
    ->contain([
      'ParentPages',
      'ChildPages',
      'Attachments',
      'Sections' => [
        'Articles' => 'Attachments',
        /*'Modules' => [
          'Articles' => 'Attachments'
        ]*/
      ]
    ])
    ->first();

    $this->set('title', $page->title);
    $this->set('description', $page->meta);
    $this->set(compact('page'));

  }

  public function display(...$path): ?Response
  {
    $count = count($path);
    if (!$count) {
      return $this->redirect('/');
    }
    if (in_array('..', $path, true) || in_array('.', $path, true)) {
      throw new ForbiddenException();
    }
    $page = $subpage = null;

    if (!empty($path[0])) {
      $page = $path[0];
    }
    if (!empty($path[1])) {
      $subpage = $path[1];
    }
    $this->set(compact('page', 'subpage'));

    try {
      $this->render(implode('/', $path));
    } catch (MissingTemplateException $exception) {
      if (Configure::read('debug')) {
        throw $exception;
      }
      throw new NotFoundException();
    }

    return $this->render();
  }
}
