<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerOlfWmCK\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerOlfWmCK/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerOlfWmCK.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerOlfWmCK\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerOlfWmCK\App_KernelDevDebugContainer([
    'container.build_hash' => 'OlfWmCK',
    'container.build_id' => '65ba6b44',
    'container.build_time' => 1736937826,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerOlfWmCK');
