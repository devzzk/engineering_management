# Artisan Make Commands Required Parameters

以下信息基于当前项目容器内执行的 `php artisan <command> --help` 整理。

默认命令前缀：

```bash
docker compose exec -it workspace php artisan
```

说明：

- `必填参数` 指命令参数区 `Arguments` 中必须提供的值。
- `关键选项` 只记录最常用、最容易影响生成结果的选项。
- 通用选项如 `--help`、`--quiet`、`--no-interaction`、`--verbose` 不再重复强调。

## 1. 基础 Laravel 代码生成

### `make:cast`

- 必填参数：`name`
- 关键选项：`--force`

### `make:channel`

- 必填参数：`name`
- 关键选项：`--force`

### `make:class`

- 必填参数：`name`
- 关键选项：`--invokable`、`--force`

### `make:command`

- 必填参数：`name`
- 关键选项：`--force`

### `make:component`

- 必填参数：`name`
- 关键选项：`--force`

### `make:config`

- 必填参数：`name`
- 关键选项：`--force`

### `make:controller`

- 必填参数：`name`
- 关键选项：`--invokable`、`--model=`、`--parent=`、`--resource`、`--requests`、`--singleton`

### `make:enum`

- 必填参数：`name`
- 关键选项：`--string`、`--int`、`--force`

### `make:event`

- 必填参数：`name`
- 关键选项：`--force`

### `make:exception`

- 必填参数：`name`
- 关键选项：`--force`

### `make:factory`

- 必填参数：`name`
- 关键选项：`--model=`

### `make:interface`

- 必填参数：`name`
- 关键选项：`--force`

### `make:job`

- 必填参数：`name`
- 关键选项：`--force`

### `make:job-middleware`

- 必填参数：`name`
- 关键选项：`--force`

### `make:listener`

- 必填参数：`name`
- 关键选项：`--event=`、`--force`

### `make:mail`

- 必填参数：`name`
- 关键选项：`--markdown=`、`--force`

### `make:middleware`

- 必填参数：`name`
- 关键选项：无

### `make:migration`

- 必填参数：`name`
- 关键选项：`--create=`、`--table=`、`--path=`

### `make:model`

- 必填参数：`name`
- 关键选项：`--all`、`--controller`、`--factory`、`--migration`、`--seed`、`--pivot`、`--resource`、`--requests`

### `make:notification`

- 必填参数：`name`
- 关键选项：`--markdown=`、`--force`

### `make:observer`

- 必填参数：`name`
- 关键选项：`--model=`、`--force`

### `make:policy`

- 必填参数：`name`
- 关键选项：`--model=`、`--guard=`、`--force`

### `make:provider`

- 必填参数：`name`
- 关键选项：`--force`

### `make:request`

- 必填参数：`name`
- 关键选项：`--force`

### `make:resource`

- 必填参数：`name`
- 关键选项：`--json-api`、`--collection`、`--force`

### `make:rule`

- 必填参数：`name`
- 关键选项：`--implicit`、`--force`

### `make:scope`

- 必填参数：`name`
- 关键选项：`--force`

### `make:seeder`

- 必填参数：`name`
- 关键选项：无

### `make:test`

- 必填参数：`name`
- 关键选项：`--unit`、`--pest`、`--phpunit`、`--force`

### `make:trait`

- 必填参数：`name`
- 关键选项：`--force`

### `make:view`

- 必填参数：`name`
- 关键选项：`--force`

## 2. 数据表辅助命令

### `make:cache-table`

- 必填参数：无
- 关键选项：无

### `make:notifications-table`

- 必填参数：无
- 关键选项：无

### `make:queue-batches-table`

- 必填参数：无
- 关键选项：无

### `make:queue-failed-table`

- 必填参数：无
- 关键选项：无

### `make:queue-table`

- 必填参数：无
- 关键选项：无

### `make:session-table`

- 必填参数：无
- 关键选项：无

## 3. Filament 面板与资源

### `make:filament-cluster`

- 必填参数：`name`
- 关键选项：`--force`

### `make:filament-exporter`

- 必填参数：`model`
- 关键选项：`--generate`、`--force`

### `make:filament-importer`

- 必填参数：`model`
- 关键选项：`--generate`、`--force`

### `make:filament-page`

- 必填参数：`name`
- 关键选项：`--cluster=`、`--resource=`、`--type=`、`--force`

### `make:filament-panel`

- 必填参数：`id`
- 关键选项：`--force`

### `make:filament-relation-manager`

- 必填参数：`resource`、`relationship`、`recordTitleAttribute`
- 关键选项：`--cluster=`、`--generate`、`--force`

### `make:filament-resource`

- 必填参数：`model`
- 关键选项：`--cluster=`、`--generate`、`--nested=`、`--simple`、`--force`

### `make:filament-theme`

- 必填参数：`panel`
- 关键选项：`--force`

### `make:filament-user`

- 必填参数：无
- 关键选项：`--name=`、`--email=`、`--password=`、`--panel=`

### `make:filament-widget`

- 必填参数：`name`
- 关键选项：`--chart`、`--resource=`、`--stats-overview`、`--table`、`--force`

## 4. Filament Schema / Table / Livewire

### `make:filament-form`

- 必填参数：`name`、`model`
- 关键选项：`--force`

### `make:filament-form-field`

- 必填参数：`name`
- 关键选项：`--force`

### `make:filament-infolist-entry`

- 必填参数：`name`
- 关键选项：`--force`

### `make:filament-livewire-form`

- 必填参数：`name`、`model`
- 关键选项：`--edit`、`--generate`、`--force`

### `make:filament-livewire-schema`

- 必填参数：`name`
- 关键选项：`--force`

### `make:filament-livewire-table`

- 必填参数：`name`、`model`
- 关键选项：`--generate`、`--force`

### `make:filament-rich-content-custom-block`

- 必填参数：`name`
- 关键选项：`--force`

### `make:filament-schema`

- 必填参数：`name`
- 关键选项：`--force`

### `make:filament-schema-component`

- 必填参数：`name`
- 关键选项：`--force`

### `make:filament-table`

- 必填参数：`name`、`model`
- 关键选项：`--generate`、`--force`

### `make:filament-table-column`

- 必填参数：`name`
- 关键选项：`--embedded-view`、`--force`

### `make:filament-issue`

- 必填参数：无
- 关键选项：无

## 5. Livewire / MCP 相关

### `make:livewire`

- 必填参数：`name`
- 关键选项：无

### `make:mcp-app-resource`

- 必填参数：`name`
- 关键选项：`--force`

### `make:mcp-prompt`

- 必填参数：`name`
- 关键选项：`--force`

### `make:mcp-resource`

- 必填参数：`name`
- 关键选项：`--force`

### `make:mcp-server`

- 必填参数：`name`
- 关键选项：`--force`

### `make:mcp-tool`

- 必填参数：`name`
- 关键选项：`--force`

## 6. 常用组合示例

### 新建模型 + 迁移 + 工厂

```bash
docker compose exec -it workspace php artisan make:model Project -mf --no-interaction
```

### 新建 Pest 测试

```bash
docker compose exec -it workspace php artisan make:test ProjectResourceTest --pest --no-interaction
```

### 新建 Filament 面板

```bash
docker compose exec -it workspace php artisan make:filament-panel admin --no-interaction
```

### 新建 Filament 资源

```bash
docker compose exec -it workspace php artisan make:filament-resource Project --panel=admin --model --migration --no-interaction
```
