# Release Notes for 9.x

## [Unreleased](https://github.com/laravel/framework/compare/v9.3.0...9.x)


## [v9.3.0 (2022-03-02)](https://github.com/laravel/framework/compare/v9.2.0...v9.3.0)

### Added
- Add NotificationFake::assertNothingSentTo() by @axlon ([#41232](https://github.com/laravel/framework/pull/41232))
- Support --ssl-ca on schema load and dump by @DeepDiver1975 ([#40931](https://github.com/laravel/framework/pull/40931))
- Add whereNot() to Query Builder and Eloquent Builder by @marcovo ([#41096](https://github.com/laravel/framework/pull/41096))
- Added support for index and position placeholders in array validation messages by @Bird87ZA ([#41123](https://github.com/laravel/framework/pull/41123))
- Add resource binding by @aedart ([#41233](https://github.com/laravel/framework/pull/41233))
- Add ability to push additional pipes onto a pipeline via chain($pipes) by @stevebauman ([#41256](https://github.com/laravel/framework/pull/41256))
- Add option to filter out routes defined in vendor packages in route:list command by @amiranagram ([#41254](https://github.com/laravel/framework/pull/41254))

### Fixed
- Query PostgresBuilder fixes for renamed config 'search_path' by @derekmd ([#41215](https://github.com/laravel/framework/pull/41215))
- Improve doctypes for Eloquent Factory guessing methods by @bastien-phi ([#41245](https://github.com/laravel/framework/pull/41245))
- Fix Conditional::when and Conditional::unless when called with invokable by @bastien-phi ([#41270](https://github.com/laravel/framework/pull/41270))
- Improves Support\Collection reduce method type definition by @fdalcin ([#41272](https://github.com/laravel/framework/pull/41272))
- Fix inconsistent results of firstOrNew() when using withCasts() by @Attia-Ahmed ([#41257](https://github.com/laravel/framework/pull/41257))
- Fix implicitBinding and withTrashed route with child with no SoftDeletes trait by @stein-j ([#41282](https://github.com/laravel/framework/pull/41282))

### Changed
- Unset Connection Resolver extended callback by @emrancu ([#41216](https://github.com/laravel/framework/pull/41216))
- Update Mailgun transport type by @driesvints ([#41255](https://github.com/laravel/framework/pull/41255))


## [v9.2.0 (2022-02-22)](https://github.com/laravel/framework/compare/v9.1.0...v9.2.0)

### Added
- Added `Illuminate/Database/Eloquent/Casts/Attribute::make()` ([#41014](https://github.com/laravel/framework/pull/41014))
- Added `Illuminate/Collections/Arr::keyBy()` ([#41029](https://github.com/laravel/framework/pull/41029))
- Added expectsOutputToContain to the PendingCommand. ([#40984](https://github.com/laravel/framework/pull/40984))
- Added ability to supply HTTP client methods with JsonSerializable instances ([#41055](https://github.com/laravel/framework/pull/41055))
- Added `Illuminate/Filesystem/AwsS3V3Adapter::getClient()` ([#41079](https://github.com/laravel/framework/pull/41079))
- Added Support for enum in Builder::whereRelation ([#41091](https://github.com/laravel/framework/pull/41091))
- Added X headers when using Mail::alwaysTo ([#41101](https://github.com/laravel/framework/pull/41101))
- Added of support Bitwise operators in query ([#41112](https://github.com/laravel/framework/pull/41112))
- Integrate Laravel CORS into framework ([#41137](https://github.com/laravel/framework/pull/41137))
- Added `Illuminate/Support/Str::betweenFirst()` ([#41144](https://github.com/laravel/framework/pull/41144))
- Allow specifiying custom messages for Rule objects ([#41145](https://github.com/laravel/framework/pull/41145))

### Fixed
- Fixed Queue Failed_jobs insert issue with Exception contain UNICODE ([#41020](https://github.com/laravel/framework/pull/41020))
- Fixes attempt to log deprecations on mocks ([#41057](https://github.com/laravel/framework/pull/41057))
- Fixed loadAggregate not correctly applying casts ([#41050](https://github.com/laravel/framework/pull/41050))
- Do not transform JsonSerializable instances to array in HTTP client methods ([#41077](https://github.com/laravel/framework/pull/41077))
- Fix parsing config('database.connections.pgsql.search_path') ([#41088](https://github.com/laravel/framework/pull/41088))
- Eloquent: firstWhere returns Object instead of NULL ([#41099](https://github.com/laravel/framework/pull/41099))
- Fixed updated with provided qualified updated_at ([#41133](https://github.com/laravel/framework/pull/41133))
- Fix setPriority Call for MailChannel ([#41120](https://github.com/laravel/framework/pull/41120))
- Fixed route:list command output ([#41177](https://github.com/laravel/framework/pull/41177))
- Fix database migrations $connection property ([#41161](https://github.com/laravel/framework/pull/41161))

### Changed
- Cursor pagination: convert original column to expression ([#41003](https://github.com/laravel/framework/pull/41003))
- Cast $perPage to integer on Paginator ([#41073](https://github.com/laravel/framework/pull/41073))
- Restore S3 client extra options ([#41097](https://github.com/laravel/framework/pull/41097))
- Use `latest()` within `notifications()` in `Illuminate/Notifications/HasDatabaseNotifications.php` ([#41095](https://github.com/laravel/framework/pull/41095))
- Remove duplicate queries to find batch ([#41121](https://github.com/laravel/framework/pull/41121))
- Remove redundant check in FormRequest::validated() ([#41115](https://github.com/laravel/framework/pull/41115))
- Illuminate/Support/Facades/Storage::fake() changed ([#41113](https://github.com/laravel/framework/pull/41113))
- Use coalesce equal as provided by PHP >= 7.4 ([#41174](https://github.com/laravel/framework/pull/41174))
- Simplify some conditions with is_countable() ([#41168](https://github.com/laravel/framework/pull/41168))
- Pass AWS temporary URL options to createPresignedRequest method ([#41156](https://github.com/laravel/framework/pull/41156))
- Let Multiple* exceptions hold the number of records and items found ([#41164](https://github.com/laravel/framework/pull/41164))


## [v9.1.0 (2022-02-15)](https://github.com/laravel/framework/compare/v9.0.2...v9.1.0)

### Added
* Added the ability to use the uniqueFor method for Jobs by @andrey-helldar in https://github.com/laravel/framework/pull/40974
* Add filtering of route:list by domain by @Synchro in https://github.com/laravel/framework/pull/40970
* Added dropForeignIdFor method to match foreignIdFor method by @bretto36 in https://github.com/laravel/framework/pull/40950
* Adds `Str::excerpt` by @nunomaduro in https://github.com/laravel/framework/pull/41000
* Make:model --morph flag to generate MorphPivot model by @michael-rubel in https://github.com/laravel/framework/pull/41011
* Add doesntContain to higher order proxies by @edemots in https://github.com/laravel/framework/pull/41034

### Changed
* Improve types on model factory methods by @axlon in https://github.com/laravel/framework/pull/40902
* Add support for passing array as the second parameter for the group method. by @hossein-zare in https://github.com/laravel/framework/pull/40945
* Makes `ExceptionHandler::renderForConsole` internal on contract by @nunomaduro in https://github.com/laravel/framework/pull/40956
* Put the error message at the bottom of the exceptions by @nshiro in https://github.com/laravel/framework/pull/40886
* Expose next and previous cursor of cursor paginator by @gdebrauwer in https://github.com/laravel/framework/pull/41001

### Fixed
* Fix FTP root config by @driesvints in https://github.com/laravel/framework/pull/40939
* Allows tls encryption to be used with port different than 465 with starttls by @nicolalazzaro in https://github.com/laravel/framework/pull/40943
* Catch suppressed deprecation logs by @nunomaduro in https://github.com/laravel/framework/pull/40942
* Fix typo in method documentation by @shadman-ahmed in https://github.com/laravel/framework/pull/40951
* Patch regex rule parsing due to `Rule::forEach()` by @stevebauman in https://github.com/laravel/framework/pull/40941
* Fix replacing request options by @driesvints in https://github.com/laravel/framework/pull/40954
* Fix `MessageSent` event by @driesvints in https://github.com/laravel/framework/pull/40963
* Add firstOr() function to BelongsToMany relation by @r-kujawa in https://github.com/laravel/framework/pull/40828
* Fix `isRelation()` failing to check an `Attribute` by @rodrigopedra in https://github.com/laravel/framework/pull/40967
* Fix default pivot attributes by @iamgergo in https://github.com/laravel/framework/pull/40947
* Fix enum casts arrayable behaviour by @diegotibi in https://github.com/laravel/framework/pull/40885
* Solve exception error: Undefined array key "", in artisan route:list command by @manuglopez in https://github.com/laravel/framework/pull/41031
* Fix Duplicate Route Namespace by @moisish in https://github.com/laravel/framework/pull/41021
* Fix the error message when no routes are detected by @LukeTowers in https://github.com/laravel/framework/pull/41017
* Fix mails with tags and metadata are not queuable by @joostdebruijn in https://github.com/laravel/framework/pull/41028


## [v9.0.2 (2022-02-10)](https://github.com/laravel/framework/compare/v9.0.1...v9.0.2)

### Added
* Add disabled directive by @belzaaron in https://github.com/laravel/framework/pull/40900

### Changed
* Widen the type of `Collection::unique` `$key` parameter by @NiclasvanEyk in https://github.com/laravel/framework/pull/40903
* Makes `ExceptionHandler::renderForConsole` internal by @nunomaduro in https://github.com/laravel/framework/pull/40936
* Removal of Google Font integration from default exception templates by @bashgeek in https://github.com/laravel/framework/pull/40926
* Allow base JsonResource class to be collected by @jwohlfert23 in https://github.com/laravel/framework/pull/40896

### Fixed
* Fix Support\Collection reject method type definition by @joecampo in https://github.com/laravel/framework/pull/40899
* Fix SpoofCheckValidation namespace change by @eduardor2k in https://github.com/laravel/framework/pull/40923
* Fix notification email recipient by @driesvints in https://github.com/laravel/framework/pull/40921
* Fix publishing visibility by @driesvints in https://github.com/laravel/framework/pull/40918
* Fix Mailable->priority() by @giggsey in https://github.com/laravel/framework/pull/40917


## [v9.0.1 (2022-02-09)](https://github.com/laravel/framework/compare/v9.0.0...v9.0.1)

### Changed
* Improves `Support\Collection` each method type definition by @zingimmick in https://github.com/laravel/framework/pull/40879

### Fixed
* Update Mailable.php by @rentalhost in https://github.com/laravel/framework/pull/40868
* Switch to null coalescing operator in Conditionable by @inxilpro in https://github.com/laravel/framework/pull/40888
* Bring back old return behaviour by @ankurk91 in https://github.com/laravel/framework/pull/40880


## [v9.0.0 (2022-02-08)](https://github.com/laravel/framework/compare/8.x...v9.0.0)

Check the upgrade guide in the [Official Laravel Upgrade Documentation](https://laravel.com/docs/9.x/upgrade). Also you can see some release notes in the [Official Laravel Release Documentation](https://laravel.com/docs/9.x/releases).
