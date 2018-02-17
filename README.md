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


