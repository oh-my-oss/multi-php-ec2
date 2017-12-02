=====================
Multi PHP setup
=====================

目次
====

.. contents::

前提
======

- Virtualbox インストール済み
- Vagrant インストール済み
- Chef Zero インストール済み
- ローカルに PHP をインストール済み

セットアップ
==============

::

    $ git clone https://github.com/oh-my-oss/multi-php-ec2.git
    $ cd multi-php-ec2
    $ git submodule init
    $ git submodule update

    $ vagrant ssh-config --host php-multi.local.com >> ~/.ssh/config
    $ cd chef-repo
    $ VG_HOST=php-multi.local.com
    $ chef exec knife zero bootstrap $VG_HOST --node-name $VG_HOST
    $ php add-fqdn.php nodes/php-multi.local.com.json
    $ chef exec knife node run_list add $VG_HOST 'role[php-web]'
    $ chef exec knife node environment set $VG_HOST vagrant
    $ chef exec knife zero converge "name:$VG_HOST"
