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
