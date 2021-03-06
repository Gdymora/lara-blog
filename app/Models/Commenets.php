<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Comments extends Model {
  // таблица комментариев в базе данных
  protected $guarded = [];
  // прокомментрировавший пользователь
  public function author()
  {
    return $this->belongsTo('App\Models\User','from_user');
  }
  // возвращает пост любого комментария
  public function post()
  {
    return $this->belongsTo('App\Models\Posts','on_post');
  }
}
