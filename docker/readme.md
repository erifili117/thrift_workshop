# Thrift Installation

The following guide is for Ubuntu-based distros.

## Dependencies

You have to have these dependencies installed in order to build thrift:

 - automake 
 - bison 
 - curl 
 - flex 
 - g++ 
 - libboost-dev 
 - libboost-filesystem-dev 
 - libboost-program-options-dev 
 - libboost-system-dev 
 - libboost-test-dev 
 - libevent-dev 
 - libssl-dev 
 - libtool 
 - make 
 - pkg-config 
 
## Installation

### Pre-installation

Download the desired version:

`$ curl -k -sSL "https://github.com/apache/thrift/archive/${THRIFT_VERSION}.tar.gz" -o thrift.tar.gz`

Create the thrift directory:

`$ mkdir -p /usr/src/thrift`

Untar in thrift dir:

`$ tar zxf thrift.tar.gz -C /usr/src/thrift --strip-components=1`

### Installation

``` bash
$ ./bootstrap.sh
$ ./configure --disable-libs 
$ make
$ make install 
```

### Post-installation

Remove unnecessary files:

``` bash
$ cd /
$ rm -rf /usr/src/thrift
$ apt-get purge -y --auto-remove $buildDeps 
$ rm -rf /var/cache/apt/* 
$ rm -rf /var/lib/apt/lists/* 
$ rm -rf /tmp/* 
$ rm -rf /var/tmp/*
```

## Install language specific dependencies 

In order for Thrift compiler to be able to compile in a specific language you'll
need to install it in your system

The following are for installing PHP:

```bash
$ apt-get update && apt-get install -y \
        php \
        php-dev \
        php-cli \
        php-pear \
        re2c \
        phpunit 
```

### Additional languages

You may find a Dockerfile with dependencies for most supported languages 
[here](https://github.com/apache/thrift/blob/master/build/docker/ubuntu-bionic/Dockerfile)
and help for all available languages [here](https://thrift.apache.org/lib/)