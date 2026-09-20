# Docker Artisan Runner References

这里是 `docker-artisan-runner` Skill 的参考资料目录。

## 文件说明

- `command-groups.md`
  说明命令按职责如何分组，便于快速定位应该使用哪类 `make:*` 命令。

- `required-parameters.md`
  记录当前项目容器中各个 `make:*` Artisan 命令的必填参数，以及常用关键选项。

## 使用建议

1. 先阅读 `SKILL.md`，确认统一执行规则。
2. 再查看 `command-groups.md`，找到目标命令所属分类。
3. 最后查看 `required-parameters.md`，确认必填参数和关键选项。

## 执行前缀

本目录中所有命令均默认使用以下前缀：

```bash
docker compose exec -it workspace
```
