---
title: PHP SDK 使用指南 | 七牛云存储
---

# PHP SDK 使用指南

此 PHP SDK 适用于 PHP5.3 版本，基于 [七牛云存储官方API](/v3/api/) 构建。使用此 SDK 构建您的网络应用程序，能让您以非常便捷地方式将数据安全地存储到七牛云存储上。无论您的网络应用是一个网站程序，还是包括从云端（服务端程序）到终端（手持设备应用）的架构的服务或应用，通过七牛云存储及其 SDK，都能让您应用程序的终端用户高速上传和下载，同时也让您的服务端更加轻盈。

七牛云存储 PHP SDK 源码地址：<https://github.com/qiniu/php5.3-sdk> 

**目录**

- [接入](#turn-on)
    - [配置密钥（AccessKey / SecretKey）](#establish_connection!)
- [使用](#Usage)
    - [文件上传](#upload)
        - [生成上传授权凭证（uploadToken）](#generate-upload-token)
        - [PHP 服务端上传文件](#upload-server-side)
        - [iOS / Android / Web 端直传文件说明](#upload-client-side)
    - [文件下载](#download)
        - [公有资源下载](#download-public-files)
        - [私有资源下载](#download-private-files)
            - [生成下载授权凭证（downloadToken）](#download-token)
        - [高级特性](#other-download-features)
            - [断点续下载](#resumable-download)
            - [自定义 404 NotFound](#upload-file-for-not-found)
    - [文件管理](#file-management)
        - [查看单个文件属性信息](#stat)
        - [复制单个文件](#copy)
        - [移动单个文件](#move)
        - [删除单个文件](#delete)
        - [批量操作](#batch)
            - [批量获取文件属性信息](#batch-get)
            - [批量复制文件](#batch-copy)
            - [批量移动文件](#batch-move)
            - [批量删除文件](#batch-delete)
    - [云处理](#cloud-processing)
        - [图像](#image-processing)
            - [查看图片属性信息](#image-info)
            - [查看图片EXIF信息](#image-exif)
            - [图像在线处理（缩略、裁剪、旋转、转化）](#image-mogrify-for-preview)
            - [图像在线处理（缩略、裁剪、旋转、转化）后并持久化存储](#image-mogrify-for-save-as)
        - 音频(TODO)
        - 视频(TODO)
- [贡献代码](#Contributing)
- [许可证](#License)