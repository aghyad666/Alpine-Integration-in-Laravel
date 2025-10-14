# Alpine Integration and Data Binding in Laravel

A showcase project demonstrating dynamically linked select elements with Alpine.js on top of database data served via Laravel.
It includes the full flow from migrations and seeders to frontend data binding, along with a Blade + Alpine structure.

## Installation

1. Clone the repository:

    Choose one:

    **GitLab**

    ```bash
    git clone https://gitlab.com/tomi-h/alpine-integration-in-laravel.git
    cd alpine-integration-in-laravel
    ```

    **GitHub**

    ```bash
    git clone https://github.com/tomm-tomm/alpine-integration-in-laravel.git
    cd alpine-integration-in-laravel
    ```

2. Install frontend dependencies:
    ```bash
    npm install
    npm run dev
    ```

3. Copy .env.example to .env and configure your database:
    ```bash
    cp .env.example .env
    ```

4. Generate app key:
    ```bash
    php artisan key:generate
    ```

5. Run migrations and seeders:
    ```bash
    php artisan migrate --seed
    ```

6. Start the Laravel development server (skip this step if you're running Apache, Nginx, Valet, or Docker):
    ```bash
    php artisan serve
    ```

## Key Parts of the Alpine Integration

**Initialize Alpine.js and register component (resources/js/app.js)**

```js
// Import Alpine.js
import Alpine from 'alpinejs';
// Import custom data component that is registered as "dynamicSelect"
import dynamicSelect from './alpine/dynamicSelect';

// Expose Alpine globally (handy for debugging and plugins)
window.Alpine = Alpine;

// Register data components:
// Make the "dynamicSelect" component available to use in HTML via x-data="dynamicSelect(...)"
Alpine.data('dynamicSelect', dynamicSelect);
// Initialize Alpine — scans the DOM and activates x-data/x-* directives
Alpine.start();
```

**Get data from database (app/Http/Controllers/CategoryController.php)**

```php
$parentCategories = Category::with(['children' => function($query) {
                                    $query->orderBy('name');
                                }])
                                ->where('type', $activeCategoryType)
                                ->whereNull('parent_id')
                                ->orderBy('name')
                                ->get();
```

**Prepare Alpine properties for the Alpine component (resources/views/form.blade.php)**

```php
// Create an associative array to pass into the Alpine component as props.
$alpineProps = [
    // Prefer the previously submitted form value for 'type' (if it exists).
    // Otherwise use $category->type; if that's null, fall back to 'expense'.
    'type' => old('type', $category->type ?? 'expense'),
    // Prefer the old 'parent_id' form value.
    // Otherwise use $category->parent_id; if null, use an empty string (no parent).
    'parentId' => old('parent_id', $category->parent_id ?? ''),
    // A collection of categories that serve as parents.
    'parents' => $parentCategories
        // Transform each item to a simple array (JSON-serializable for the frontend).
        ->map(fn($p) => [
            // Cast 'id' to string (stable for JSON/front-end handling).
            'id' => (string) $p->id,
            // Display name of the category.
            'name' => $p->name,
            // Category type ('expense' or 'income').
            'type' => $p->type,
        ])
        // Reindex keys to 0, 1, 2... (drops original keys).
        ->values(),
];
```

**Bind Alpine props to a Blade form (resources/views/form.blade.php)**

```php
<x-forms.form
    method="POST"
    action="{{ isset($category) ? route('update', $category->id) : route('store') }}"
    x-data="{!! 'categoryForm(' . Js::from($alpineProps) . ')' !!}"
>

<x-forms.select
    label="Type"
    name="type"
    x-model="type"
>

<x-forms.select
    label="Parent category"
    name="parent_id"
    note="Select if category has a parent category."
    x-model="parent_id"
>
    <option value="">— None —</option>
    <template x-for="p in filteredParents()" :key="p.id">
        <option :value="String(p.id)" x-text="p.name" :selected="String(p.id) === String(parent_id)"></option>
    </template>
</x-forms.select>
```

## Project Structure:

- app/ – main application logic (model, controller, services...)
- database/migrations/ – database migrations
- database/seeders/ – database seeders
- resources/css/ – CSS files
- resources/js/ – JS files
- resources/images - images
- resources/views/ – Blade templates
- routes/web.php – route definitions

## Thanks:

Thanks to Jeffrey Way for the inspiration behind the Blade form components:<br>
https://github.com/laracasts/pixel-position/tree/main/resources/views/components/forms
