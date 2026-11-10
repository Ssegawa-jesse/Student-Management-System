# Team task plan — 8 members

Every member **commits and pushes from their own GitHub account**. Nobody shares passwords, and nobody pushes for someone else. The lecturer checks the commit history.

The finished, tested code for every file below is in the shared zip `student-management-system-laravel12.zip` (Jesse shares it in the group chat). Each member copies **only their files** from the zip into the repo, reads them so they can explain them at the presentation, then commits and pushes.

## Who does what

| # | Member | Branch | Files to add or replace (from the zip) |
| --- | --- | --- | --- |
| 1 | **Ssegawa Jesse** (leader) | `feature/fix-migrations-team-plan` | All of `database/migrations/` (fix migration order) · `README.md` · `docs/` · `tests/Feature/StudentManagementTest.php` · `tests/Feature/RegistrationTest.php` · `tests/Feature/ExampleTest.php` |
| 2 | **Mawanda Jabel** | `feature/models` | `app/Models/Programme.php`, `Lecturer.php`, `User.php`, `Student.php`, `Course.php`, `CourseRegistration.php` |
| 3 | **Wamala Adrian** | `feature/seeders-update` | `database/seeders/RolesAndPermissionsSeeder.php`, `ProgrammeSeeder.php`, `UserSeeder.php`, `CourseSeeder.php`, `CourseRegistrationSeeder.php`, `DatabaseSeeder.php` (delete `StudentSeeder.php`; students are created in `UserSeeder`) |
| 4 | **Niyomukunzi Adeline** | `feature/auth-approvals` | `bootstrap/app.php` · `app/Http/Middleware/EnsureUserIsApproved.php` · `app/Http/Responses/RegisterResponse.php` · `app/Providers/FortifyServiceProvider.php` · `app/Actions/Fortify/CreateNewUser.php`, `UpdateUserProfileInformation.php` · `app/Policies/*` · `app/Http/Controllers/Admin/ApprovalController.php`, `UserController.php` · `resources/views/admin/approvals/`, `admin/users/` · `resources/views/auth/*` · `resources/views/errors/403.blade.php` |
| 5 | **Ainembabazi Agatha** | `feature/student-crud` | `app/Http/Controllers/Admin/StudentController.php`, `Admin/DashboardController.php` · `app/Http/Requests/StudentRequest.php` · `resources/views/admin/students/*` · `resources/views/admin/dashboard.blade.php` |
| 6 | **Namiiro Bronia** | `feature/course-crud` | `app/Http/Controllers/Admin/CourseController.php`, `ProgrammeController.php`, `LecturerController.php` · `app/Http/Requests/CourseRequest.php`, `ProgrammeRequest.php`, `LecturerRequest.php` · `resources/views/admin/courses/*`, `admin/programmes/*`, `admin/lecturers/*` |
| 7 | **Katusabe Brenda** | `feature/course-registration` | `app/Services/CourseRegistrationService.php` · `app/Http/Controllers/Admin/RegistrationController.php`, `Admin/ReportController.php` · `app/Http/Controllers/Student/*` · `resources/views/admin/registrations/*`, `admin/reports.blade.php` · `resources/views/student/*` |
| 8 | **Nayiga Sharlot** | `feature/layout-lecturer-routes` | `routes/web.php` · `app/Http/Controllers/Controller.php`, `DashboardController.php`, `HomeController.php`, `ContactController.php`, `Lecturer/*` · `app/View/Components/*` · `resources/views/layouts/*`, `partials/*`, `components/*` (incl. `components/ui/`), `welcome.blade.php`, `public/*`, `lecturer/*` · `resources/css/app.css`, `resources/js/app.js`, `tailwind.config.js`, `package.json` · `public/assets/` |

## Steps for each member

```bash
# 1. Get the latest develop
git checkout develop
git pull origin develop

# 2. Make your branch (use the name from the table)
git checkout -b feature/models

# 3. Copy YOUR files from the zip into the same paths in the repo.
#    Commit in 2–4 small commits, not one giant one, e.g.:
git add app/Models/Programme.php app/Models/Lecturer.php
git commit -m "feat(models): add Programme and Lecturer models with hasMany relationships"
git add app/Models/Student.php app/Models/Course.php app/Models/CourseRegistration.php
git commit -m "feat(models): add belongsToMany between students and courses"

# 4. Push and open a Pull Request into develop on GitHub
git push -u origin feature/models
```

On GitHub, open the pull request with **base: `develop`** and compare set to your branch. Ask one other member to review it before it's merged.

Before committing, set your name once so the commits show you:

```bash
git config --global user.name "Your Name"
git config --global user.email "you@example.com"
```

Use the email of your GitHub account.

## Merge order (to avoid broken builds)

1. Jesse — migrations
2. Mawanda — models
3. Wamala — seeders
4. Adeline — auth and approvals
5. Agatha, Bronia and Brenda — CRUD and registration (any order)
6. Sharlot — routes and layout, **last**, because `routes/web.php` points at everyone's controllers

## Final check (Jesse, after all PRs are in develop)

```bash
composer install
npm install && npm run build
php artisan migrate:fresh --seed
php artisan test
php artisan serve
```

Log in as the admin, a lecturer and a student (see `README.md`). Then open a PR from `develop` → `main`.
