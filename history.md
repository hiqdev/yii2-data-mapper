# hiqdev/yii2-data-mapper

## [Under development]

- Inited: actually cut off from `hiqdev\hiapi`
    - [fff9653] 2017-12-04 fixed to new namespace: `hidev\yii\DataMapper` [@hiqsol]
    - [7e303f4] 2017-12-03 csfixed [@hiqsol]
    - [3f4c747] 2017-12-03 redoing to `yii2-data-mapper` <- hiapi [@hiqsol]
    - [f9eb187] 2017-11-27 added DB expressions for array, call and hstore [@hiqsol]
    - [c4e1c50] 2017-11-27 added DI config for EntityManager [@hiqsol]
    - [e889aae] 2017-11-27 added entity manager to BaseRepository [@hiqsol]
    - [56e2b45] 2017-11-27 added DB connection to EntityManager, added interface [@hiqsol]
    - [b794f5b] 2017-10-19 added passing common config to tests [@hiqsol]
    - [95dad7d] 2017-10-17 added HOSTS param (to be passed from environment) [@hiqsol]
    - [fd6acd8] 2017-10-06 moved bus related stuff to `yii2-autobus` [@hiqsol]
    - [f5a1892] 2017-10-05 added require yii2-autobus [@hiqsol]
    - [f64db1b] 2017-10-05 moving bus things to yii2-autobus [@hiqsol]
    - [8f4d222] 2017-09-21 added `AbstractTool::getBase` [@hiqsol]
    - [71556ef] 2017-09-20 crutchfixed WTF `base->di` becomes null after passing as argument [@hiqsol]
    - [8348073] 2017-09-20 added `AbstractTool` [@hiqsol]
    - [ffadf1d] 2017-09-11 added hardcoded findAllRelations for getting prices for plan [@hiqsol]
    - [fd14009] 2017-07-21 redone findOne through findAll [@hiqsol]
    - [c26d342] 2017-07-21 used ActiveQueryTrait in Specification for `with` [@hiqsol]
    - [4a4169d] 2017-06-30 csfixed [@hiqsol]
    - [85bcaa3] 2017-06-30 refactored Field and Specification: validation and condition building moved into Field <- Specification [@hiqsol]
    - [a52fd20] 2017-06-30 added Query::initFrom [@hiqsol]
    - [a8a0829] 2017-06-30 added FieldInterface [@hiqsol]
    - [be2280f] 2017-06-23 fixed Specification::applyWhereTo [@hiqsol]
    - [b930c37] 2017-06-13 A lot of changes [@SilverFire]
    - [6373f27] 2017-06-12 removed return type declaration for 5.6 compatibility [@hiqsol]
    - [f9b405e] 2017-06-09 Enhanced Query::restoreHierarchy() to support multi-dimensional data [@SilverFire]
    - [be5c703] 2017-06-09 Bill search [@SilverFire]
    - [2a83869] 2017-06-08 Removed BaseRepository::splitDbRawData() [@SilverFire]
    - [9d10cbb] 2017-06-07 Added basic fields validation [@SilverFire]
    - [85994b4] 2017-06-06 added splitDbRawData [@hiqsol]
    - [1f5fd8f] 2017-06-06 Updated NestedModelValidator to support model creation [@SilverFire]
    - [e9577fa] 2017-06-06 added BaseRepository::createEntity [@hiqsol]
    - [a017dde] 2017-06-02 Added NestedModelValidator, disabled CSRF validation [@SilverFire]
    - [fad2ec5] 2017-06-02 csfixed [@hiqsol]
    - [8a3d519] 2017-06-02 added custom query variant implementation in BaseRepository [@hiqsol]
    - [88ba9b2] 2017-06-01 Added ConnectionInterface, inited specifications and QueryMutation [@SilverFire]
    - [f3d9329] 2017-05-31 moved getQueryOptions to SearchHandler <- SearchCommand [@hiqsol]
    - [fe53c92] 2017-05-30 Added NearbyHandlerLocator, refactored BaseCommand [@SilverFire]
    - [09c84d5] 2017-05-30 refactored command bus [@SilverFire]
    - [54758a7] 2017-05-29 refactored [@hiqsol]
    - [ceb7687] 2017-05-25 refactored SearchCommand/Handler [@hiqsol]
    - [3fab90c] 2017-05-25 implemented base of search command and handler [@hiqsol]
    - [41dd95e] 2017-05-19 inited SearchCommand/Handler [@hiqsol]
    - [f40dd54] 2017-05-19 added PingCommand/Handler [@hiqsol]
    - [50b54a8] 2017-05-19 renamed BaseCommand <- Command [@hiqsol]
    - [1df4820] 2017-05-18 added ContentNegotiator to output JSON [@hiqsol]
    - [bbd80cd] 2017-05-18 added LoadMiddleware [@hiqsol]
    - [2dddc83] 2017-05-18 basically implemented bus working [@hiqsol]
    - [04ceba5] 2017-05-17 added proper command building [@hiqsol]
    - [897cdb3] 2017-05-17 in the middle [@hiqsol]
    - [da73feb] 2017-05-16 added require vlucas/phpdotenv [@hiqsol]
    - [24931e7] 2017-05-16 csfixed [@hiqsol]
    - [8e29760] 2017-05-16 improved configs: added defines and params like in hisite [@hiqsol]
    - [eed53bf] 2017-05-16 renamed `web` <- hiapi [@hiqsol]
    - [8f238b2] 2017-05-16 fixed hidev config [@hiqsol]
    - [cce3dd0] 2017-05-16 renamed to `hiapi` [@hiqsol]
    - [4441dbb] 2017-05-16 renamed `hidev.yml` [@hiqsol]
    - [4e8cf37] 2017-05-16 added CommandBus component [@hiqsol]
    - [50f76d9] 2017-04-07 added web controller [@hiqsol]
    - [db3f1de] 2017-04-07 added console controller and hidev config [@hiqsol]
    - [688ff4a] 2017-04-05 inited [@hiqsol]

## [Development started] - 2017-04-05

[@hiqsol]: https://github.com/hiqsol
[sol@hiqdev.com]: https://github.com/hiqsol
[@SilverFire]: https://github.com/SilverFire
[d.naumenko.a@gmail.com]: https://github.com/SilverFire
[@tafid]: https://github.com/tafid
[andreyklochok@gmail.com]: https://github.com/tafid
[@BladeRoot]: https://github.com/BladeRoot
[bladeroot@gmail.com]: https://github.com/BladeRoot
[fff9653]: https://github.com/hiqdev/yii2-data-mapper/commit/fff9653
[7e303f4]: https://github.com/hiqdev/yii2-data-mapper/commit/7e303f4
[3f4c747]: https://github.com/hiqdev/yii2-data-mapper/commit/3f4c747
[f9eb187]: https://github.com/hiqdev/yii2-data-mapper/commit/f9eb187
[c4e1c50]: https://github.com/hiqdev/yii2-data-mapper/commit/c4e1c50
[e889aae]: https://github.com/hiqdev/yii2-data-mapper/commit/e889aae
[56e2b45]: https://github.com/hiqdev/yii2-data-mapper/commit/56e2b45
[b794f5b]: https://github.com/hiqdev/yii2-data-mapper/commit/b794f5b
[95dad7d]: https://github.com/hiqdev/yii2-data-mapper/commit/95dad7d
[fd6acd8]: https://github.com/hiqdev/yii2-data-mapper/commit/fd6acd8
[f5a1892]: https://github.com/hiqdev/yii2-data-mapper/commit/f5a1892
[f64db1b]: https://github.com/hiqdev/yii2-data-mapper/commit/f64db1b
[8f4d222]: https://github.com/hiqdev/yii2-data-mapper/commit/8f4d222
[71556ef]: https://github.com/hiqdev/yii2-data-mapper/commit/71556ef
[8348073]: https://github.com/hiqdev/yii2-data-mapper/commit/8348073
[ffadf1d]: https://github.com/hiqdev/yii2-data-mapper/commit/ffadf1d
[fd14009]: https://github.com/hiqdev/yii2-data-mapper/commit/fd14009
[c26d342]: https://github.com/hiqdev/yii2-data-mapper/commit/c26d342
[4a4169d]: https://github.com/hiqdev/yii2-data-mapper/commit/4a4169d
[85bcaa3]: https://github.com/hiqdev/yii2-data-mapper/commit/85bcaa3
[a52fd20]: https://github.com/hiqdev/yii2-data-mapper/commit/a52fd20
[a8a0829]: https://github.com/hiqdev/yii2-data-mapper/commit/a8a0829
[be2280f]: https://github.com/hiqdev/yii2-data-mapper/commit/be2280f
[b930c37]: https://github.com/hiqdev/yii2-data-mapper/commit/b930c37
[6373f27]: https://github.com/hiqdev/yii2-data-mapper/commit/6373f27
[f9b405e]: https://github.com/hiqdev/yii2-data-mapper/commit/f9b405e
[be5c703]: https://github.com/hiqdev/yii2-data-mapper/commit/be5c703
[2a83869]: https://github.com/hiqdev/yii2-data-mapper/commit/2a83869
[9d10cbb]: https://github.com/hiqdev/yii2-data-mapper/commit/9d10cbb
[85994b4]: https://github.com/hiqdev/yii2-data-mapper/commit/85994b4
[1f5fd8f]: https://github.com/hiqdev/yii2-data-mapper/commit/1f5fd8f
[e9577fa]: https://github.com/hiqdev/yii2-data-mapper/commit/e9577fa
[a017dde]: https://github.com/hiqdev/yii2-data-mapper/commit/a017dde
[fad2ec5]: https://github.com/hiqdev/yii2-data-mapper/commit/fad2ec5
[8a3d519]: https://github.com/hiqdev/yii2-data-mapper/commit/8a3d519
[88ba9b2]: https://github.com/hiqdev/yii2-data-mapper/commit/88ba9b2
[f3d9329]: https://github.com/hiqdev/yii2-data-mapper/commit/f3d9329
[fe53c92]: https://github.com/hiqdev/yii2-data-mapper/commit/fe53c92
[09c84d5]: https://github.com/hiqdev/yii2-data-mapper/commit/09c84d5
[54758a7]: https://github.com/hiqdev/yii2-data-mapper/commit/54758a7
[ceb7687]: https://github.com/hiqdev/yii2-data-mapper/commit/ceb7687
[3fab90c]: https://github.com/hiqdev/yii2-data-mapper/commit/3fab90c
[41dd95e]: https://github.com/hiqdev/yii2-data-mapper/commit/41dd95e
[f40dd54]: https://github.com/hiqdev/yii2-data-mapper/commit/f40dd54
[50b54a8]: https://github.com/hiqdev/yii2-data-mapper/commit/50b54a8
[1df4820]: https://github.com/hiqdev/yii2-data-mapper/commit/1df4820
[bbd80cd]: https://github.com/hiqdev/yii2-data-mapper/commit/bbd80cd
[2dddc83]: https://github.com/hiqdev/yii2-data-mapper/commit/2dddc83
[04ceba5]: https://github.com/hiqdev/yii2-data-mapper/commit/04ceba5
[897cdb3]: https://github.com/hiqdev/yii2-data-mapper/commit/897cdb3
[da73feb]: https://github.com/hiqdev/yii2-data-mapper/commit/da73feb
[24931e7]: https://github.com/hiqdev/yii2-data-mapper/commit/24931e7
[8e29760]: https://github.com/hiqdev/yii2-data-mapper/commit/8e29760
[eed53bf]: https://github.com/hiqdev/yii2-data-mapper/commit/eed53bf
[8f238b2]: https://github.com/hiqdev/yii2-data-mapper/commit/8f238b2
[cce3dd0]: https://github.com/hiqdev/yii2-data-mapper/commit/cce3dd0
[4441dbb]: https://github.com/hiqdev/yii2-data-mapper/commit/4441dbb
[4e8cf37]: https://github.com/hiqdev/yii2-data-mapper/commit/4e8cf37
[50f76d9]: https://github.com/hiqdev/yii2-data-mapper/commit/50f76d9
[db3f1de]: https://github.com/hiqdev/yii2-data-mapper/commit/db3f1de
[688ff4a]: https://github.com/hiqdev/yii2-data-mapper/commit/688ff4a
[Under development]: https://github.com/hiqdev/yii2-data-mapper/releases
