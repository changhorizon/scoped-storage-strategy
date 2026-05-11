# Scoped Storage Strategy

> A pluggable and namespace-aware storage abstraction for temporarily persisting key-value data during scoped user interactions.

![License](https://img.shields.io/github/license/changhorizon/scoped-storage-strategy?style=flat-square)
![Latest Version](https://img.shields.io/packagist/v/changhorizon/scoped-storage-strategy?style=flat-square)
![PHP Version](https://img.shields.io/badge/php-8.2--8.4-blue?style=flat-square)
![Static Analysis](https://img.shields.io/badge/static_analysis-PHPStan-blue?style=flat-square)
![Tests](https://img.shields.io/badge/tests-PHPUnit-brightgreen?style=flat-square)
[![codecov](https://codecov.io/gh/changhorizon/scoped-storage-strategy/branch/main/graph/badge.svg)](https://codecov.io/gh/changhorizon/scoped-storage-strategy)
![CI](https://github.com/changhorizon/scoped-storage-strategy/actions/workflows/ci.yml/badge.svg?style=flat-square)

Supports session-based (cookie and token) and Redis-based implementations, designed to decouple application logic from underlying storage mechanisms. Ideal for tracking transient states — such as validation progress, multistep workflows, or temporary metadata.

## ✨ 特性

- 🍪 **Cookie-based PHP session** — traditional web applications
- 🆔 **Token-based PHP session** — stateless API support
- 🚀 **Redis storage** — shared, scalable scenarios
- 🔌 PSR-style interface for easy integration and extension
- ✅ Unified interface with `put`, `get`, `exists`, `remove`, `clear`

## 📦 安装

```bash
composer require changhorizon/scoped-storage-strategy
```

## 📂 目录结构

```txt
src/
├── ScopedStorageStrategyInterface.php
├── SessionInitializerInterface.php
├── Session/
│   ├── SessionStorageStrategy.php
│   ├── SessionInitializerWithCookie.php
│   └── SessionInitializerWithToken.php
└── Redis/
    └── RedisStorageStrategy.php
```

## 🚀 用法示例

### SessionStorageStrategy with Cookie

```php
use ChangHorizon\ScopedStorageStrategy\SessionStorageStrategy;
use ChangHorizon\ScopedStorageStrategy\SessionInitializerWithCookie;

$initializer = new SessionInitializerWithCookie();
$strategy = new SessionStorageStrategy('scope-123', $initializer);

$strategy->put('demo-file-123', '/path/to/demo-file-123');
$value = $strategy->get('demo-file-123');
```

### SessionStorageStrategy with Token

```php
use ChangHorizon\ScopedStorageStrategy\SessionStorageStrategy;
use ChangHorizon\ScopedStorageStrategy\SessionInitializerWithToken;

$token = $_GET['token'] ?? '';
$initializer = new SessionInitializerWithToken($token);
$strategy = new SessionStorageStrategy('scope-456', $initializer);

$strategy->put('demo-file-456', '/path/to/demo-file-456');
$value = $strategy->get('demo-file-456');
```

### RedisStorageStrategy

```php
use ChangHorizon\ScopedStorageStrategy\RedisStorageStrategy;

$redis = new \Redis();
$redis->connect('127.0.0.1', 6379);

$strategy = new RedisStorageStrategy('scope-789', $redis);

$strategy->put('demo-file-789', '/path/to/demo-file-789');
$value = $strategy->get('demo-file-789');
```

## 📐 接口说明

All strategies implement:

```php
namespace ChangHorizon\ScopedStorageStrategy;

interface ScopedStorageStrategyInterface
{
    public function put(string $key, string $value): void;
    public function get(string $key): ?string;
    public function exists(string $key): bool;
    public function remove(string $key): void;
    public function all(): ?array;
    public function empty(): bool;
    public function clear(): void;
}
```

Session-based strategies require a session initializer:

```php
namespace ChangHorizon\ScopedStorageStrategy;

interface SessionInitializerInterface
{
    public function initialize(): void;
}
```

## 🔍 静态分析

```bash
composer stan
```

## 🎯 代码风格

```bash
composer cs:chk    # check
composer cs:fix    # auto-fix
```

## ✅ 单元测试

```bash
composer test
composer test:coverage
```

## 🤝 贡献指南

欢迎 Issue 与 PR，建议遵循以下流程：

1. Fork 仓库
2. 创建新分支进行开发
3. 提交 PR 前请确保测试通过、风格一致
4. 提交详细描述

## 📜 License

MIT License. See the [LICENSE](LICENSE) file for details.
