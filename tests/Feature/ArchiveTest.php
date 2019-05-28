<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 28/05/19
 * Time: 9:31 PM
 */

namespace Tests\Feature;

use Grafite\Cms\Models\Archive;
use Grafite\Cms\Models\Blog;
use Illuminate\Support\Facades\Hash;
use Tests\Models\User;
use Tests\TestCase;

class ArchiveTest extends TestCase
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function testAssignUpdated()
    {
        $user = new User();
        $user->name = 'User';
        $user->email = 'example@example.com';
        $user->password = Hash::make('password');
        $user->save();
        $this->actingAs($user);

        $foo = new Archive();
        $foo->token = '';
        $foo->entity_id = 1;
        $foo->entity_type = Blog::class;
        $foo->entity_data = '';
        $foo->save();

        /** @var Archive $foo */
        $foo = Archive::findOrFail($foo->getKey());

        $nuUser = $foo->updatedBy()->firstOrFail();
        $this->assertEquals($user->getKey(), $nuUser->getKey());
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function testNoAssignUpdated()
    {
        $foo = new Archive();
        $foo->token = '';
        $foo->entity_id = 1;
        $foo->entity_type = Blog::class;
        $foo->entity_data = '';
        $foo->save();

        /** @var Archive $foo */
        $foo = Archive::findOrFail($foo->getKey());

        $nuUser = $foo->updatedBy()->first();
        $this->assertNull($nuUser);
    }
}