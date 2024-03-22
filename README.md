# Qati3 Development Roadmap

## Auth
- [x] Add [Laravel Socialite](https://laravel.com/docs/10.x/socialite#introduction)
- ##### Web
    - [x] Sign in using email / password
    - [x] Sign in using Socialite
    - [x] Tests
- ##### API
    - [x] Sign in using email / password
    - [x] Tests

## Category
- [ ] Add categories CRUD functionality with validation
- [ ] Add categories tests

## Brand
- [x] Add brands CRUD functionality
- [x] Add brands list
- [ ] Add brand show view
- [ ] Add brands tests
- [ ] Move brands validation and logic to BrandService

### brands table structure
|column|type|notes|
|-----|----|------|
|id|unsignedBigInteger|PK|
|name|json|We use json for multiple translations|
|description|json|We use json for multiple translations|
|boycott_status|enum|(0, 1, 2, 3) denoting `unknown`, `neutral`, `boycotted`, `supported` statuses respectively. Default (0)|
|visibility|unsignedTinyInteger|boolean (0\|1) denoting brand visibility on web app and API, default (0) denoting `invisible`.|
|parent_brand_id|unsignedBigInteger|PK referencing parent brand if applicable, nullable|
|established_at|date|brand establishment date|
|created_at|timestamp|Timestamp when database entry was first created.|
|updated_at|timestamp|Timestamp when database entry was last updated.|
|deleted_at|timestamp|Timestamp when database entry was soft deleted, nullable|

<!-- |region_id|unsignedBigInteger|PK referencing brand region if applicable, nullable| -->


## Misc.
- [x] Add [Spatie Media Library](https://spatie.be/docs/laravel-medialibrary/v10/introduction)
- [ ] Add Tags
- [ ] Add Comments
- [ ] Add voting system
