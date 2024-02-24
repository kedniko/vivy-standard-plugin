<?php

namespace Tests;

use Kedniko\Vivy\V;
use Kedniko\Vivy\Core\GroupContext;

uses()->group('transformer');

test('transformer-1', function () {
    $v = V::group([
        'name' => V::string()->addTransformer(function (GroupContext $gc) {
            $value = $gc->value;

            return strtoupper($value);
        }),
        'password' => V::string(),
    ]);

    $validated = $v->validate([
        'name' => 'niko',
    ]);

    expect($validated->value())->tobe([
        'name' => 'NIKO',
    ]);

    expect($validated->errors())->toBe([
        'password' => [
            'required' => ['Questo campo è obbligatorio'],
        ],
    ]);
});
