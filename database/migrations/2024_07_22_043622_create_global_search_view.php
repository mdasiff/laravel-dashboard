<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("DROP VIEW IF EXISTS global_search");
        DB::statement('
            CREATE VIEW global_search AS

            -- blog_categories

            SELECT 
                title as name,
                slug,
                "blog_categories" AS table_name,
                CONCAT("/blog/", slug) AS url,
                "Blog" AS flag
            FROM 
                blog_categories

            UNION ALL

            -- blogs

            SELECT 
                title as name,
                slug,
                "blogs" AS table_name,
                CONCAT("/blog/", slug) AS url,
                "Blog" AS flag
            FROM 
                blogs

            UNION ALL

            -- industry_categories

            SELECT 
                name,
                slug,
                "industry_categories" AS table_name,
                CONCAT("/industries/", slug) AS url,
                "Industry" AS flag
            FROM 
                industry_categories

            UNION ALL

            -- industries

            SELECT 
                name,
                slug,
                "industries" AS table_name,
                CONCAT("/industries/", slug) AS url,
                "Industry" AS flag
            FROM 
                industries

            UNION ALL


            -- solution_categories

            SELECT 
                name,
                slug,
                "solution_categories" AS table_name,
                CONCAT("/solutions/", slug) AS url,
                "Solution" AS flag
            FROM 
                solution_categories


            UNION ALL

            -- solutions

            SELECT 
                name,
                slug,
                "solutions" AS table_name,
                CONCAT("/solutions/", slug) AS url,
                "Solution" AS flag
            FROM 
                solutions

            UNION ALL

            -- product_categories

            SELECT 
                name,
                slug,
                "product_categories" AS table_name,
                CONCAT("/solutions/", slug) AS url,
                "Product" AS flag
            FROM 
                product_categories


            UNION ALL

            -- products

            SELECT 
                name,
                slug,
                "products" AS table_name,
                CONCAT("/products/", slug) AS url,
                "Product" AS flag
            FROM 
                products


            UNION ALL

            -- -- news

            -- SELECT 
            --     title as name,
            --     slug,
            --     "news" AS table_name,
            --     CONCAT("/news/", slug) AS url,
            --     "News" AS flag
            -- FROM 
            --     news

            -- UNION ALL

            -- service_categories

            SELECT 
                name,
                slug,
                "service_categories" AS table_name,
                CONCAT("/services/", slug) AS url,
                "Service" AS flag
            FROM 
                service_categories

            UNION ALL
            
            -- services

            SELECT 
                name,
                name as slug,
                "services" AS table_name,
                CONCAT("/services/", slug) AS url,
                "Service" AS flag
            FROM 
                services;


        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS global_search');
    }
};
