LILLYDOO Test Task
========

#### Missing features

- paging on list action
- delete confirmation
- no fixtures 
- possible issues with large images/imagick, but perpaps only recreatable on my desktop

#### Prerequisites

- free 80 port
- `docker`, `docker-compose`
- `composer`, `yarn`, both in the `PATH`
- PHP >= 7 with imagick PECL extension (required for `LiipImagineBundle`)
- `make` (optional)

#### Installation

- add `lillydo.int` to your hosts file (optional, you can just use :80)
- `make build && make run`
