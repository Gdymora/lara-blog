<?php 

namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
class User extends Model implements AuthenticatableContract, CanResetPasswordContract {
  use Authenticatable, CanResetPassword;
  /**
   * База данных используемая моделью.
   *
   * @var string
   * Функции posts() и comments() связывают пользователя с постами и комментариями. 
   * Функция can_post() проверяет может ли пользователь публиковать пост или нет.
   *  Функция is_admin() проверяет имеет пользователь роль admin или нет.
   */
  protected $table = 'users';
  /**
   * Массово назначаемые аттрибуты.
   *
   * @var array
   */
  protected $fillable = ['name', 'email', 'password'];
  /**
   * Исключённые аттрибуты из JSON формы модели.
   *
   * @var array
   */
  protected $hidden = ['password', 'remember_token'];
  // у одного пользователя множество постов
  public function posts()
  {
    return $this->hasMany('App\Models\Posts','author_id');
  }
  // у пользователя много комментариев
  public function comments()
  {
    return $this->hasMany('App\Models\Comments','from_user');
  }
  public function can_post()
  {
    $role = $this->role;
    if($role == 'author' || $role == 'admin')
    {
      return true;
    }
    return false;
  }
  public function is_admin()
  {
    $role = $this->role;
    if($role == 'admin')
    {
      return true;
    }
    return false;
  }
}
