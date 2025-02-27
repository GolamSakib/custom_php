<?php
namespace Tests;
use PHPUnit\Framework\TestCase;
use app\Controllers\AuthController;
use app\Models\User;
use app\Utils\FileUploader;
use core\Request;

class AuthControllerTest extends TestCase {
    protected $authController;
    protected $userModelMock;
    protected $requestMock;
    protected $fileUploaderMock;

    protected function setUp(): void {
        $this->userModelMock = $this->createMock(User::class);
        $this->requestMock = $this->createMock(Request::class);
        $this->fileUploaderMock = $this->createMock(FileUploader::class);

        $this->authController = new AuthController(
            $this->userModelMock,
            $this->requestMock,
            $this->fileUploaderMock
        );
    }

    public function testRegisterSuccess() {
        // Mock request inputs
        $this->requestMock->method('input')
            ->will($this->returnValueMap([
                ['name', 'John Doe'],
                ['email', 'john@example.com'],
                ['password', 'password123'],
            ]));

        // Mock file upload
        $this->fileUploaderMock->method('upload')
            ->willReturn('avatar.png');

        // Mock user model
        $this->userModelMock->method('findBy')
            ->with('email', 'john@example.com')
            ->willReturn(null);

        $this->userModelMock->method('create')
            ->willReturn(true);

        // Start output buffering
        ob_start();
        $this->authController->register();
        $output = ob_get_clean();

        // Assert output
        $this->assertStringContainsString('User registered successfully', $output);
    }

    public function testRegisterUserAlreadyExists() {
        // Mock request inputs
        $this->requestMock->method('input')
            ->will($this->returnValueMap([
                ['name', 'John Doe'],
                ['email', 'john@example.com'],
                ['password', 'password123'],
            ]));

        // Mock user model
        $this->userModelMock->method('findBy')
            ->with('email', 'john@example.com')
            ->willReturn(['email' => 'john@example.com']);

        // Start output buffering
        ob_start();
        $this->authController->register();
        $output = ob_get_clean();

        // Assert output
        $this->assertStringContainsString('User with email john@example.com already exists', $output);
    }

    public function testRegisterFailure() {
        // Mock request inputs
        $this->requestMock->method('input')
            ->will($this->returnValueMap([
                ['name', 'John Doe'],
                ['email', 'john@example.com'],
                ['password', 'password123'],
            ]));

        // Mock file upload
        $this->fileUploaderMock->method('upload');

        // Mock user model
        $this->userModelMock->method('findBy')
            ->with('email', 'john@example.com')
            ->willReturn(null);

        $this->userModelMock->method('create')
            ->willReturn(false);

        // Start output buffering
        ob_start();
        $this->authController->register();
        $output = ob_get_clean();

        // Assert output
        $this->assertStringContainsString('User registration failed', $output);
    }
}
?>
