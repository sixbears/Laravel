<!doctype html>
<html>
    <head>
        <!-- META Tags -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo e(isset($title) ? $title . ' | ' : null); ?><?php echo e(config('app.name')); ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- SEO -->
        <meta name="author" content="<?php echo e(config('larecipe.seo.author')); ?>">
        <meta name="description" content="<?php echo e(config('larecipe.seo.description')); ?>">
        <meta name="keywords" content="<?php echo e(config('larecipe.seo.keywords')); ?>">
        <meta name="twitter:card" value="summary">
        <?php if(isset($canonical) && $canonical): ?>
            <link rel="canonical" href="<?php echo e(url($canonical)); ?>" />
        <?php endif; ?>
        <?php if($openGraph = config('larecipe.seo.og')): ?>
            <?php $__currentLoopData = $openGraph; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($value): ?>
                    <meta property="og:<?php echo e($key); ?>" content="<?php echo e($value); ?>" />
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <!-- CSS -->
        <link rel="stylesheet" href="<?php echo e(larecipe_assets('css/app.css')); ?>">

        <!-- Favicon -->
        <link rel="apple-touch-icon" href="<?php echo e(asset(config('larecipe.ui.fav'))); ?>">
        <link rel="shortcut icon" type="image/png" href="<?php echo e(asset(config('larecipe.ui.fav'))); ?>"/>

        <!-- FontAwesome -->
        <link rel="stylesheet" href="<?php echo e(larecipe_assets('css/font-awesome.css')); ?>">
        <?php if(config('larecipe.ui.fa_v4_shims', true)): ?>
            <link rel="stylesheet" href="<?php echo e(larecipe_assets('css/font-awesome-v4-shims.css')); ?>">
        <?php endif; ?>

        <!-- Dynamic Colors -->
        <?php echo $__env->make('larecipe::style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <?php $__currentLoopData = LaRecipe::allStyles(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $path): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <link rel="stylesheet" href="<?php echo e(route('larecipe.styles', $name)); ?>">
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		
		<!-- Base url -->
		<base href="<?php echo e(Config::get('app.url')); ?>/" />
    </head>
    <body>
        <div id="app" v-cloak>
            <?php echo $__env->make('larecipe::partials.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->make('larecipe::plugins.search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->yieldContent('content'); ?>

            <larecipe-back-to-top></larecipe-back-to-top>
        </div>


        <script>
            window.config = <?php echo json_encode([], 15, 512) ?>;
        </script>

        <script src="<?php echo e(larecipe_assets('js/app.js')); ?>"></script>

        <script>
            window.LaRecipe = new CreateLarecipe(config)
        </script>

        <!-- Google Analytics -->
        <?php if(config('larecipe.settings.ga_id')): ?>
            <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo e(config('larecipe.settings.ga_id')); ?>"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', "<?php echo e(config('larecipe.settings.ga_id')); ?>");
            </script>
        <?php endif; ?>
        <!-- /Google Analytics -->

        <?php $__currentLoopData = LaRecipe::allScripts(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $path): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <script src="<?php echo e(route('larecipe.scripts', $name)); ?>"></script>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <script>
            LaRecipe.run()
        </script>
    </body>
</html>
<?php /**PATH D:\xampp\laravel\vendor\binarytorch\larecipe\src/../resources/views/default.blade.php ENDPATH**/ ?>