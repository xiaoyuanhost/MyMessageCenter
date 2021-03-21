# MyMessageCenter
MyMessageCenter 开源个人消息中心，用于接收管理同步个人的消息
1. 主要定义功能、交互标准、交互接口
2. 前后端分离
3. 提供简单实现用于用户自搭建
4. 提供一个在线的站点

### 功能列表：
|  功能   | 描述  |
|  ----  | ----  |
| 接口设计  | - |
| 前端页面  | - |
| 接口实现  | 简单PHP实现[pneedle-framework](https://github.com/timsengit/pneedle-framework)， |


# 整体架构及相关API接口设计  
## 接口使用RESTful  
> 鉴权相关  
>> /user/login  
>> /user/logout  
>> /user/info  
  
> 消息应用  
>> /app

  
> 消息列表  
>> /message  
  
> 消息处理者  
>> /worker  
