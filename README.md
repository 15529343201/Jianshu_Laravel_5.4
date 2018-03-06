### laravel
- 数据库迁移
- 数据填充
- 模型关联建立
- Elasticsearch全文检索引擎服务搭建使用
- 基于数据库的异步队列操作
- 如何设计表格更符合laravel的默认约定
- 如何理解laravel的依赖注入容器等思想
- 如何设计权限管理系统
- 如何使用laravel控制用户权限
### 项目结构
前台<br>
- 文章模块
- 用户模块
- 评论模块
- 赞模块
- 搜索模块
- 个人中心模块
后台<br>
- 后台架构
- 管理人员模块
- 审核模块
- 权限模块
- 专题模块
- 系统通知模块
### 使用Laravel的功能
![image](https://github.com/15529343201/Jianshu_Laravel_5.4/blob/chapter1/image/l1.PNG)
![image](https://github.com/15529343201/Jianshu_Laravel_5.4/blob/chapter1/image/l2.PNG)

### chapter2:Laravel5.4介绍
Laravel的特性<br>
- 优雅
- 简介
- 工程化

Laravel的历史版本<br>
![image](https://github.com/15529343201/Jianshu_Laravel_5.4/blob/chapter2/image/l3.PNG)

Laravel的社区生态<br>
- 官网(https://laravel.com/)
- 中文社区(https://laravel-china.org/)
- 5.4中文文档(http://d.laravel-china.org/docs/5.4)
- Laravel源码地址(https://github.com/laravel/laravel)

Laravel的优势<br>
- Laravel包含的功能更为丰富<br>
&emsp;&emsp;1.队列<br>
&emsp;&emsp;2.搜索<br>
&emsp;&emsp;3.数据库迁移<br>
&emsp;&emsp;4.定时脚本<br>
- Laravel使用了丰富的第三方包<br>
&emsp;&emsp;1.composer管理<br>
&emsp;&emsp;2.数据填充包(https://github.com/fzaninotto/Faker/)<br>
- Laravel的思想更为先进<br>
&emsp;&emsp;1.服务容器<br>
&emsp;&emsp;2.服务提供者<br>
&emsp;&emsp;3.比如缓存服务<br>
- Laravel的社区更为丰富<br>
&emsp;&emsp;1.国际化<br>
&emsp;&emsp;2.基于laravel的开源项目多<br>
&emsp;&emsp;3.开源<br>

### chapter3:安装启动Laravel
### Laravel5.4安装环境要求<br>
- PHP>=5.6.4
- PHP扩展<br>
&emsp;1.OpenSSL PHP Extension<br>
&emsp;2.PDO PHP Extension<br>
&emsp;3.Mbstring PHP Extension<br>
&emsp;4.Tokenizer PHP Extenesion<br>
&emsp;5.XML PHP Extension<br>
- Mysql

环境准备<br>
`yum install -y epel-release`<br>
`yum install gcc bison bison-devel zlib-devel libmcrypt-devel mcrypt mhash-devel openssl-devel libxml2-devel libcurl-devel bzip2-devel readline-devel libedit-devel sqlite-devel jemalloc jemalloc-devel libmcrypt-devel`<br>
`cd /usr/local/src`<br>
`wget http://cn2.php.net/distributions/php-5.6.30.tar.gz`<br>
`tar zvxf php-5.6.30.tar.gz`<br>
`cd php-5.6.30`<br>
`groupadd www`<br>
`useradd -g www -s /sbin/nologin www`<br>

编译安装<br>
```
./configure --prefix=/usr/local/php \
--with-config-file-path=/usr/local/php/etc \
--enable-inline-optimization --disable-debug \
--disable-rpath --enable-shared --enable-opcache \
--enable-fpm --with-fpm-user=www \
--with-fpm-group=www \
--with-mysql=mysqlnd \
--with-mysqli=mysqlnd \
--with-pdo-mysql=mysqlnd \
--with-gettext \
--enable-mbstring \
--with-iconv \
--with-mcrypt \
--with-mhash \
--with-openssl \
--enable-bcmath \
--enable-soap \
--with-libxml-dir \
--enable-pcntl \
--enable-shmop \
--enable-sysvmsg \
--enable-sysvsem \
--enable-sysvshm \
--enable-sockets \
--with-curl --with-zlib \
--enable-zip \
--with-bz2 \
--with-readline
```
`make && make install`<br>

配置服务<br>
`cp php.ini-development /usr/local/php/etc/php.ini`<br>
`cp /usr/local/php/etc/php-fpm.conf.default /usr/local/php/etc/php-fpm.conf`<br>
`cp sapi/fpm/init.d.php-fpm /etc/init.d/php-fpm`<br>
`chmod +x /etc/init.d/php-fpm`<br>
`chkconfig --add php-fpm`<br>
`chkconfig php-fpm`<br>
`service php-fpm start`<br>

环境变量<br>
`vim /etc/profile`<br>
`export PATH=$PATH:/usr/local/php/bin`<br>
`source /etc/profile`<br>

安装Mysql<br>

1.新开的云服务器，需要检测系统是否自带安装mysql<br>
`yum list installed | grep mysql`<br>
2.如果发现有系统自带mysql，果断这么干<br>
`yum -y remove mysql-libs.x86_64`<br>
3.随便在你存放文件的目录下执行，这里解释一下，由于这个mysql的yum源服务器在国外，所以下载速度会比较慢，还好mysql5.6只有79M大，而mysql5.7就有182M了，所以这是我不想安装mysql5.7的原因<br>
`wget http://repo.mysql.com/mysql-community-release-el6-5.noarch.rpm`<br>
4.接着执行这句,解释一下，这个rpm还不是mysql的安装文件，只是两个yum源文件，执行后，在/etc/yum.repos.d/ 这个目录下多出mysql-community-source.repo和mysql-community.repo<br>
`rpm -ivh mysql-community-release-el6-5.noarch.rpm`<br>
5.这个时候，可以用yum repolist mysql这个命令查看一下是否已经有mysql可安装文件<br>
`yum repolist all | grep mysql`<br>
6.安装mysql 服务器命令（一路yes）：<br>
`yum install mysql-community-server`<br>
7.安装成功后<br>
`service mysqld start`<br>
8.由于mysql刚刚安装完的时候，mysql的root用户的密码默认是空的，所以我们需要及时用mysql的root用户登录（第一次回车键，不用输入密码），并修改密码<br>
`mysql -u root`<br>
`use mysql;`<br>
`update user set password=PASSWORD("这里输入root用户密码") where User='root';`<br>
`flush privileges;`<br>
9.查看mysql是否自启动,并且设置开启自启动命令<br>
`chkconfig --list | grep mysqld`<br>
`chkconfig mysqld on`<br>

### composer安装
- https://pkg.phpcomposer.com
- 安装composer(https://pkg.phpcomposer.com/#how-to-install-composer)
- 配置中国镜像(composer config -g repo.packagist composer https://packagist.phpcomposer.com)
- 创建laravel项目(composer create-project laravel/laravel laravel54 "5.4.*")

### 启动Laravel
- Nginx?Apache?(http://d.laravel-china.org/docs/5.4/installation)
- php artisan serve

### 文件夹介绍
- 逻辑代码:app
- 配置文件:config
- 数据库管理:database
- 对外资源:public

### 修改.env数据库配置文件
`DB_DATABASE=laravel54`<br>
`DB_USERNAME=root`<br>
`DB_PASSWORD=123456`<br>
生成数据迁移表:<br>
`php artisan migrate:install`<br>

### chapter4:文章模块
![image](https://github.com/15529343201/Jianshu_Laravel_5.4/blob/chapter4/image/l4.PNG)

### Laravel路由
![image](https://github.com/15529343201/Jianshu_Laravel_5.4/blob/chapter4/image/l5.PNG)

http方法:<br>
```PHP
Route::get('/', '[控制器]@[行为]');
Route::put('/posts', '\App\Http\Controllers\PostController@index');
/*
<form action="/posts" method="POST">
  <input type="hidden" name="_method" value="PUT" />
  {{ method_field("PUT") }} //和上句话等价
</form>
*/
```

路由参数<br>
```PHP
Route::get('/posts/{id}', '\App\Http\Controllers\PostController@index');
function index($id)
{
  $id = 57;
}
```

路由分组<br>
```PHP
Route::group(['prefix' => 'posts'], function(){
  Route::put('/', '\App\Http\Controllers\PostController@index');
  Route::put('/{id}', '\App\Http\Controllers\PostController@index');
  Route::put('/create', '\App\Http\Controllers\PostController@index');
});
```

绑定模型<br>
```PHP
// post => 表:posts => 主键:id
Route::get('/posts/{post}', '\App\Http\Controllers\PostController@show');
function show(\App\Post $post){
  //.....
}
```

### 文章路由
- 文章列表
- 添加文章
- 编辑文章
- 删除文章
- 文章详情

`php artisan help make:controller`<br>
`php artisan make:controller PostController`<br>

### Laravel的模板
- 使用的是blade模板
- 模板语法{{}} @if @foreach
- 参数传递
- 继承模型extends/section/yield/content
- 引入视图include

### 文章模块的页面模板调整
- 提取layout
- 提取footer
- 提取nav

### 文章模块数据表
- 使用migrate创建数据表
- 表名posts
- 外键user_id
- 时间created_at/updated_at

`php artisan make:migration create_posts_table`<br>
`php artisan migrate`<br>
```
+------------+------------------+------+-----+---------+----------------+
| Field      | Type             | Null | Key | Default | Extra          |
+------------+------------------+------+-----+---------+----------------+
| id         | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| title      | varchar(100)     | NO   |     |         |                |
| content    | text             | NO   |     | NULL    |                |
| user_id    | int(11)          | NO   |     | 0       |                |
| created_at | timestamp        | YES  |     | NULL    |                |
| updated_at | timestamp        | YES  |     | NULL    |                |
+------------+------------------+------+-----+---------+----------------+
```
<br>

### 文章模块模型
- ORM
- 创建posts的模型
- tinker的使用
- 基本的增删改查

创建模型:`php artisan make:model Post`<br>
`php artisan tinker`<br>
```
>>> $post=new \App\Post();
=> App\Post {#697}
>>> $post->title="this is post3";
=> "this is post3"
>>> $post->content="this is post3 content";
=> "this is post3 content"
>>> $post->save();
=> true
```
```
>>> \App\Post::find(1);
=> App\Post {#705
     id: 1,
     title: "this is post3",
     content: "this is post3 content",
     user_id: 0,
     created_at: "2018-02-26 07:52:52",
     updated_at: "2018-02-26 07:52:52",
   }
```
```
>>> \App\Post::where('title', 'this is post3')->first();
=> App\Post {#711
     id: 1,
     title: "this is post3",
     content: "this is post3 content",
     user_id: 0,
     created_at: "2018-02-26 07:52:52",
     updated_at: "2018-02-26 07:52:52",
   }
>>> \App\Post::where('title', 'this is post3')->get();
=> Illuminate\Database\Eloquent\Collection {#706
     all: [
       App\Post {#709
         id: 1,
         title: "this is post3",
         content: "this is post3 content",
         user_id: 0,
         created_at: "2018-02-26 07:52:52",
         updated_at: "2018-02-26 07:52:52",
       },
     ],
   }
```
```
修改:
$post=\App\Post::find(1);
$post->title = "this is post2";
$post->save();
```
```
删除:
$post->delete();
```

### 文章列表逻辑
- 模型查找
- 页面渲染
- 时间格式http://carbon.nesbot.com/docs/
- 数据填充https://github.com/fzaninotto/Faker/
- 字符截断
- 分页

数据填充<br>
```PHP
$factory->define(App\Post::class, function(Faker\Generator $faker){
        return [
            'title' => $faker->sentence(6),
            'content' => $faker->paragraph(10),
        ];
});
```
`php artisan tinker`<br>
`>>>factory(App\Post::class, 10)->make(); 只打印在屏幕上,并未插入数据库`<br>
`>>>factory(App\Post::class, 20)->create();插入到数据库`<br>

分页<br>
```PHP
public function index()
{
    $posts = Post::orderBy('created_at', 'desc')->paginate(6);
    return view("post/index", compact('posts'));
}
```
`{{$posts->links()}}`<br>

字符截断<br>
`{{str_limit($post->content, 100, '...')}}`<br>

### 文章详情逻辑
- 控制器
- 路由绑定
- 页面编写
- 列表页补充

### 文章添加逻辑
- 控制器
- csrf
- 保存model
- 验证和错误提示
- 错误提示本地化

`php artisan storage:link`<br>

### Laravel核心思想
### 服务容器:<br>
- 容器概念
- IOC控制反转
- DI依赖注入

Laravel中的容器:<br>
- 绑定

```PHP
$this->app->bind("HelpSpot\API', function($app) {
  return new HelpSpot\API($app->make('HttpClient'));
});

$this->app->singleton('HelpSpot\API', function($app) {
  return new HelpSpot\API($app->make('HttpClient'));
});
```

- 解析

```PHP
$api = $this->app->make('HelpSpot\API');
```
`bootstrap/app.php`<br>
`public/index.php`<br>

### 服务提供者
- 概念
- 服务提供注册
- 延迟服务提供

`public function register()`<br>
`public function boot()`<br>
`protected $defer = true;`<br>

`config/app.php`<br>

### 门脸模式
- 静态调用

```PHP
public function index()
{
  $params = \Request::all();
```

- app.php -> aliases
 
### 日志类
![image](https://github.com/15529343201/Jianshu_Laravel_5.4/blob/chapter5/image/16.PNG)

### 如何查找一个门脸类或注入类有哪些函数
- 门脸类

`>>> app('request')`<br>

- 注入类

`>>> app('Symfony\Component\HttpFoundation\Request')`<br>

- https://laravel.com/api/5.4/

### 用户模块
删除Auth Controller<br>

### 路由和控制器
- 登陆路由
- 注册路由
- 登陆控制器
- 注册控制器
- 个人设置

### Auth门脸类
- Auth门脸方法
- Auth的配置文件流程

```PHP
if(Auth::attempt(['email' => $email, 'password' => $password], $remeber)) {
  // 这个用户被记住了...
}

Auth::logout();
// 获取当前已通过认证的用户...
$user = Auth::user();
// 获取当前已通过认证的用户id...
$id = Auth::id();
```

### 用户授权Policy
- 定义策略类
- 注册策略类和模型关联

```PHP
if($user->can('update',$post)) {
  //
}

@can('update',$post)
  <!--当前用户可以更新博客-->
@elsecan('create',$post)
  <!--当前用户可以新建博客-->
@endcan

$this->authorize('update',$post);
```

- 策略判断

### 相关认证权限
- 文章创建增加用户
- 控制器
- Layout
- 文章编辑权限
- 退出

`php artisan make:policy PostPolicy`<br>

### 评论模块
`php artisan make:migration create_comments_table`<br>
```PHP
+------------+------------------+------+-----+---------+----------------+
| Field      | Type             | Null | Key | Default | Extra          |
+------------+------------------+------+-----+---------+----------------+
| id         | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| post_id    | int(11)          | NO   |     | NULL    |                |
| content    | text             | NO   |     | NULL    |                |
| user_id    | int(11)          | NO   |     | NULL    |                |
| created_at | timestamp        | YES  |     | NULL    |                |
| updated_at | timestamp        | YES  |     | NULL    |                |
+------------+------------------+------+-----+---------+----------------+
```

### Laravel模型关联
- 一对一 hasOne(用户-手机号)
- 一对多 hasMany(文章-评论)
- 一对多反向 belongsTo(评论-文章)
- 多对多 belongsToMany(用户-角色)
- 远层一对多 hasManyThrough(国家-作者-文章)
- 多态关联 morphMany(文章/视频-评论)
- 多态多对多 morphToMany(文章/视屏-标签)
- 排序orderBy

`php artisan make:model Comment`<br>

### 评论列表逻辑
- 模型关联预加载
- 模板

```PHP
$books = App\Book::with('author')->get();
$books->load('author','publisher');
```

### 文章列表页评论数
- 模型关联计数

```PHP
$posts = App\Post::withCount('comments')->get();
```

### 赞模块
`php artisan make:migration create_zans_table`<br>
```PHP
+------------+------------------+------+-----+---------+----------------+
| Field      | Type             | Null | Key | Default | Extra          |
+------------+------------------+------+-----+---------+----------------+
| id         | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| post_id    | int(11)          | NO   |     | NULL    |                |
| user_id    | int(11)          | NO   |     | NULL    |                |
| created_at | timestamp        | YES  |     | NULL    |                |
| updated_at | timestamp        | YES  |     | NULL    |                |
+------------+------------------+------+-----+---------+----------------+
```

`php artisan make:model Zan`<br>
文章列表的喜欢数和评论数:withCount<br>

### 搜索模块
- 搜索设计

&emsp;es介绍<br>
&emsp;中文支持<br>
&emsp;基本概念<br>

- Es搭建

&emsp;es搭建<br>
&emsp;laravel相关<br>
&emsp;模型关联<br>

- 页面搭建
- 业务逻辑

&emsp;搜索逻辑<br>
&emsp;分页<br>

### 搜索设计
- 搜索功能分析
- Elasticsearch选取 https://www.elastic.co/cn/
- Elasticsearch介绍
- Elasticsearch中文支持 https://github.com/medcl/elasticsearch-analysis-ik

Elasticsearch基本概念:<br>
![image](https://github.com/15529343201/Jianshu_Laravel_5.4/blob/chapter9/image/17.PNG)

### 搜索模块实现基本步骤
- 安装elasticsearch和ik插件
- Elasticsearch和laravel scout包安装
- 创建ylaravel的索引和模板
- 导入数据库已有的数据
- 搜索页面和逻辑展示

elasticsearch安装:<br>
- https://github.com/medcl/elasticsearch-rtf
- 测试安装

安装jdk8:<br>
1.切换到usr/local/src目录下:<br>
`cd /usr/local/src`<br>
下载jdk1.8的包:http://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html<br>
2.下载完后解压tar包<br>
`tar -zxvf jdk-8u152-linux-x64.tar.gz`<br>
3.将解压后的文件夹剪切到usr/local目录下，并改名为jdk8<br>
`mv jdk1.8_152 ../jdk8`<br>

5.配置环境变量<br>
`vim /etc/profile`<br>
在该文件尾部追加如下代码：<br>
`JAVA_HOME=/usr/local/jdk8`<br>
`JRE_HOME=/usr/local/jdk8/jre`<br>
`CLASS_PATH=.:$JAVA_HOME/lib`<br>
`PATH=$JAVA_HOME/bin:$JRE_HOME/bin:$PATH`<br>
`export JAVA_HOME JRE_HOME PATH CLASS_PATH`<br>
追加完成后更新配置：`source /etc/profile`<br>
查看是否安装成功：`java -version`<br>

安装elasticsearch(内存要大于2G,否则会报错):<br>
`bin/elasticsearch-plugin list`<br>
删除不必要的插件:<br>
`bin/elasticsearch-plugin list > /tmp/plugin.log`<br>
`vim /tmp/plugin.log`去掉analysis-id<br>
`cat /tmp/plugin.log|xargs -I {} bin/elasticsearch-plugin remove {}`<br>

启动:`bin/elasticsearch -d`<br>
`ps aux|grep java`<br>
`cat logs/elasticsearch.log`<br>

安装laravel使用的elastic的包<br>
- 安装laravel/scout(http://d.laravel-china.org/docs/5.4/scout)
- 安装scout的es驱动(https://github.com/ErickTamayo/laravel-scout-elastic)
- 修改scout.php

Laravel自定义命令行<br>
- 创建Command
- 编辑handle
- 挂载

自定义脚本创建es的index和template<br>
- laravel自定义脚本介绍
- 创建index
- 创建template

`php artisan make:command ESInit`<br>
`composer require guzzlehttp/guzzle`<br>
`php artisan es:init`<br>

### 导入POST数据
- 修改POST的模型
- 导入post数据
- 测试新增删除数据

导入数据:`php artisan scout:import "\App\Post"`<br>

### 个人中心模块
- 表设计

&emsp;表设计<br>
&emsp;模型<br>

- 页面搭建
- 业务逻辑

&emsp;路由<br>
&emsp;控制器<br>
&emsp;js<br>

`php artisan make:migration create_fans_table`<br>
`php artisan make:model Fan`<br>

### 模型逻辑
- 获取某个用户关注数
- 获取某个用户的关注用户列表stars
- 获取某个用户粉丝数
- 获取某个用户的粉丝用户列表fans
- 获取某个用户文章数
- 获取某个用户的文章列表posts
- 我是否已经关注某个用户hasStar
- 我是否被某个用户关注hasFan
- 增加我对某个用户的关注doFan
- 取消我对某个用户的关注doUnfan
- 通过Fan获取关注用户信息fuser
- 通过Fan获取粉丝用户信息suser

### 页面逻辑
- 控制器
- 页面
- JS编写
- 相关链接

### 专题模块
`php artisan make:migration create_topics_table`<br>
`php artisan make:migration create_post_topic_table`<br>
```
+------------+------------------+------+-----+---------+----------------+
| Field      | Type             | Null | Key | Default | Extra          |
+------------+------------------+------+-----+---------+----------------+
| id         | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| name       | varchar(30)      | NO   |     |         |                |
| created_at | timestamp        | YES  |     | NULL    |                |
| updated_at | timestamp        | YES  |     | NULL    |                |
+------------+------------------+------+-----+---------+----------------+
```
```
+------------+------------------+------+-----+---------+----------------+
| Field      | Type             | Null | Key | Default | Extra          |
+------------+------------------+------+-----+---------+----------------+
| id         | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| post_id    | int(11)          | NO   |     | 0       |                |
| topic_id   | int(11)          | NO   |     | 0       |                |
| created_at | timestamp        | YES  |     | NULL    |                |
| updated_at | timestamp        | YES  |     | NULL    |                |
+------------+------------------+------+-----+---------+----------------+
```

`php artisan make:model Topic`<br>
`php artisan make:model PostTopic`<br>
