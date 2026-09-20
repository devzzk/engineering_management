---
name: "docker-artisan-runner"
description: "Runs Laravel development commands in Docker and organizes Artisan command usage. Invoke when using php artisan, composer, Pest, or Pint in this workspace."
---

# Docker Artisan Runner

本 Skill 用于统一当前项目中的 Laravel 开发命令执行方式，尤其是 `php artisan` 命令。

## 何时使用

在以下场景应优先使用本 Skill：

- 需要执行任意 `php artisan` 命令
- 需要创建 Laravel 代码骨架，如模型、迁移、资源、测试、Filament 资源
- 需要在 Docker 容器内运行 Laravel 相关开发命令
- 需要执行 `composer`、`vendor/bin/pest`、`vendor/bin/pint` 等 Laravel 项目常用命令

## 硬性规则

### 1. 所有 Laravel 开发命令都必须在容器内执行

本项目执行命令时，默认必须加上以下前缀：

```bash
docker compose exec -it workspace
```

例如：

```bash
docker compose exec -it workspace php artisan make:model Project -mf --no-interaction
docker compose exec -it workspace php artisan make:filament-resource Project --panel=admin --no-interaction
docker compose exec -it workspace composer show --direct
docker compose exec -it workspace vendor/bin/pest tests/Feature/ExampleTest.php
docker compose exec -it workspace vendor/bin/pint --dirty --format agent
```

### 2. 生成类命令优先加 `--no-interaction`

只要命令支持 `--no-interaction`，默认都应追加，避免交互式阻塞。

例如：

```bash
docker compose exec -it workspace php artisan make:migration create_projects_table --no-interaction
docker compose exec -it workspace php artisan make:filament-panel admin --no-interaction
```

### 3. 修改前先看帮助

在不确定参数时，先运行帮助命令：

```bash
docker compose exec -it workspace php artisan list
docker compose exec -it workspace php artisan make:model --help
docker compose exec -it workspace php artisan make:filament-resource --help
```

## 常用命令模板

### Artisan 基础模板

```bash
docker compose exec -it workspace php artisan <command>
```

### Composer 模板

```bash
docker compose exec -it workspace composer <command>
```

### Pest 模板

```bash
docker compose exec -it workspace vendor/bin/pest <path-or-filter>
```

### Pint 模板

```bash
docker compose exec -it workspace vendor/bin/pint --dirty --format agent
```

## 目录结构

本 Skill 目录建议保持以下结构：

```text
.trae/skills/docker-artisan-runner/
├── SKILL.md
└── references/
    ├── index.md
    ├── command-groups.md
    └── required-parameters.md
```

## 参考资料

- 命令分组索引：`references/command-groups.md`
- 各命令必填参数与关键选项：`references/required-parameters.md`
- 参考资料入口：`references/index.md`

## Artisan 命令分类

以下命令按用途整理，执行时统一套用前缀：

```bash
docker compose exec -it workspace php artisan ...
```

### 1. 基础 Laravel 生成命令

- `make:cast`
- `make:channel`
- `make:class`
- `make:command`
- `make:component`
- `make:config`
- `make:controller`
- `make:enum`
- `make:event`
- `make:exception`
- `make:factory`
- `make:interface`
- `make:job`
- `make:job-middleware`
- `make:listener`
- `make:mail`
- `make:middleware`
- `make:migration`
- `make:model`
- `make:notification`
- `make:observer`
- `make:policy`
- `make:provider`
- `make:request`
- `make:resource`
- `make:rule`
- `make:scope`
- `make:seeder`
- `make:test`
- `make:trait`
- `make:view`

示例：

```bash
docker compose exec -it workspace php artisan make:model Project -mf --no-interaction
docker compose exec -it workspace php artisan make:test ProjectResourceTest --pest --no-interaction
docker compose exec -it workspace php artisan make:request StoreProjectRequest --no-interaction
```

### 2. 表相关命令

- `make:cache-table`
- `make:notifications-table`
- `make:queue-batches-table`
- `make:queue-failed-table`
- `make:queue-table`
- `make:session-table`

示例：

```bash
docker compose exec -it workspace php artisan make:cache-table --no-interaction
docker compose exec -it workspace php artisan make:session-table --no-interaction
```

### 3. Filament 面板与资源命令

- `make:filament-cluster`
- `make:filament-exporter`
- `make:filament-importer`
- `make:filament-page`
- `make:filament-panel`
- `make:filament-relation-manager`
- `make:filament-resource`
- `make:filament-theme`
- `make:filament-user`
- `make:filament-widget`

示例：

```bash
docker compose exec -it workspace php artisan make:filament-panel admin --no-interaction
docker compose exec -it workspace php artisan make:filament-resource Project --panel=admin --model --migration --no-interaction
docker compose exec -it workspace php artisan make:filament-relation-manager ProjectResource components name --attach --panel=admin --no-interaction
```

### 4. Filament 表单、表格、Schema 命令

- `make:filament-form`
- `make:filament-form-field`
- `make:filament-infolist`
- `make:filament-infolist-entry`
- `make:filament-infolist-schema`
- `make:filament-layout`
- `make:filament-livewire-form`
- `make:filament-livewire-schema`
- `make:filament-livewire-table`
- `make:filament-schema`
- `make:filament-schema-component`
- `make:filament-schema-layout`
- `make:filament-table`
- `make:filament-table-column`

### 5. Filament / 富文本自定义块命令

- `make:custom-block`
- `make:filament-custom-block`
- `make:filament-rich-content-custom-block`
- `make:filament-rich-editor-custom-block`
- `make:rich-content-custom-block`
- `make:rich-editor-custom-block`

### 6. 通用表单 / Infolist / Livewire 命令

- `make:form-field`
- `make:form-layout`
- `make:infolist-entry`
- `make:infolist-layout`
- `make:infolist-schema`
- `make:livewire`
- `make:livewire-form`
- `make:livewire-schema`
- `make:livewire-table`
- `make:table-column`

### 7. MCP 相关命令

- `make:mcp-app-resource`
- `make:mcp-prompt`
- `make:mcp-resource`
- `make:mcp-server`
- `make:mcp-tool`

## 推荐执行顺序

当需要新增一项 Laravel 功能时，优先按下面顺序执行：

1. 先看帮助：`docker compose exec -it workspace php artisan <command> --help`
2. 再生成骨架：`docker compose exec -it workspace php artisan make:... --no-interaction`
3. 然后实现代码
4. 最后运行格式化和测试

## 常用验证命令

```bash
docker compose exec -it workspace php artisan list
docker compose exec -it workspace php artisan route:list
docker compose exec -it workspace composer show --direct
docker compose exec -it workspace vendor/bin/pint --dirty --format agent
docker compose exec -it workspace vendor/bin/pest
```

## 注意事项

- 除非用户明确要求，否则不要省略 `docker compose exec -it workspace`
- 除非用户明确要求，否则不要直接在宿主机执行 `php artisan`
- 生成代码前优先确认命令参数，避免多次返工
- 本 Skill 以 Laravel 开发命令为主，其中 `php artisan` 为核心场景
