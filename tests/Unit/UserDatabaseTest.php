<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserDatabaseTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Insert and select user
     *
     * @return void
     */
    public function testDatabaseUserInserted()
    {
        $insertedUser = factory(User::class)->create();

        $selectedUser = User::find($insertedUser->id);

        $this->assertEquals($insertedUser->name, $selectedUser->name);
        $this->assertEquals($insertedUser->email, $selectedUser->email);
        $this->assertEquals($insertedUser->password, $selectedUser->password);
    }

    /**
     * Update and select user
     *
     * @return void
     */
    public function testDatabaseUserUpdated()
    {
        $insertedUser = factory(User::class)->create();
        $userToUpdate = factory(User::class)->make();
        
        $insertedUser->update([
            'name' => $userToUpdate->name,
            'email' => $userToUpdate->email,
            'password' => $userToUpdate->password]);
        
        $updatedUser = User::find($insertedUser->id);

        $this->assertEquals($updatedUser->name, $userToUpdate->name);
        $this->assertEquals($updatedUser->email, $userToUpdate->email);
        $this->assertEquals($updatedUser->password, $userToUpdate->password);
    }

    /**
     * Delete user
     *
     * @return void
     */
    public function testDatabaseUserDeleted()
    {
        $insertedUser = factory(User::class)->create();

        $deleted = $insertedUser->destroy($insertedUser->id);
        $notFound = User::find($insertedUser->id);
        
        $this->assertEquals($deleted, true);
        $this->assertEquals($notFound, null);
    }
}
