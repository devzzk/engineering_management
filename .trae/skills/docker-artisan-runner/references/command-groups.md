# Artisan Make Commands By Group

以下命令均默认使用：

```bash
docker compose exec -it workspace php artisan ...
```

## 1. 基础 Laravel 代码生成

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

## 2. 数据表辅助命令

- `make:cache-table`
- `make:notifications-table`
- `make:queue-batches-table`
- `make:queue-failed-table`
- `make:queue-table`
- `make:session-table`

## 3. Filament 面板与资源

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

## 4. Filament Schema / Table / Livewire

- `make:filament-form`
- `make:filament-form-field`
- `make:filament-infolist-entry`
- `make:filament-livewire-form`
- `make:filament-livewire-schema`
- `make:filament-livewire-table`
- `make:filament-rich-content-custom-block`
- `make:filament-schema`
- `make:filament-schema-component`
- `make:filament-table`
- `make:filament-table-column`

## 5. Livewire / MCP 相关

- `make:livewire`
- `make:mcp-app-resource`
- `make:mcp-prompt`
- `make:mcp-resource`
- `make:mcp-server`
- `make:mcp-tool`

## 6. 推荐查阅顺序

1. 先用 `php artisan list --raw` 确认命令存在。
2. 再用 `php artisan <command> --help` 查看完整帮助。
3. 最后结合 `required-parameters.md` 填写必填参数。
