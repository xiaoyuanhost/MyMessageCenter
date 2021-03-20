# pneedle-framework
组件化开发框架，needle 从一根针开始，极简如针

----
PHP开发有两种方式：1，使用框架；2基于组件。
本项目虽名曰框架，但是使用的是基于组件的开发方式，各个组件包使用composer（composer是未来）管理，已达到写脚本的开发速度

项目缘起于自己使用的脚本库的PHP部分，开发过程中总会使用到各种脚本：shell很简单，但是如果涉及到比如稍微复杂的redis操作就无能为力。
使用PHP是因为composer的第三方库很丰富，生态比较好，管理起来也方便。

本项目只追求极简的开发脚本速度，不会再建立各种概念，使用时只需要知道： **你想做什么、相关库的使用方法**

-----
默认选项：（不需要时请在composer.json移出相关依赖）
### 数据库
##### Models: catfan/medoo 
### 缓存 
##### Redis: predis/predis


## Get Started
> composer require pneedle/framework  
> cd public  
> php -S 0.0.0.0:1234  
> 访问 http://localhost:1234/index.php?s=index/index


## License
 
 pneedle is under the MIT license.
 
 ## Links
 
 * Official website: [pneedle-framework](https://github.com/timsengit/pneedle-framework)
