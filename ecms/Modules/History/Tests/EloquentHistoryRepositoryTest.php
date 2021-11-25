<?php

namespace Modules\History\Tests;

use Modules\History\Entities\History;
use Modules\History\Repositories\HistoryRepository;

class EloquentHistoryRepositoryTest extends BaseTestCase
{
    /**
     * @var HistoryRepository
     */
    private $history;

    public function setUp()
    {
        parent::setUp();
        $this->history = app(HistoryRepository::class);
    }

    /** @test */
    public function it_can_create_a_history()
    {
        $history = $this->history->create([
            'user_id' => 1,
            'icon_class' => 'fa fa-link',
            'link' => 'http://localhost/users',
            'title' => 'My history',
            'message' => 'Is awesome!',
        ]);

        $this->assertCount(1, $this->history->all());
        $this->assertEquals('1' , $history->user_id);
        $this->assertEquals('fa fa-link' , $history->icon_class);
        $this->assertEquals('http://localhost/users' , $history->link);
        $this->assertEquals('My history' , $history->title);
        $this->assertEquals('Is awesome!' , $history->message);
    }

    /** @test */
    public function it_can_fetch_latest_history_for_user()
    {
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory(['user_id' => 2]);
        $this->createHistory(['user_id' => 2]);

        $this->assertCount(10, $this->history->latestForUser(1));
        $this->assertCount(2, $this->history->latestForUser(2));
    }

    /** @test */
    public function it_can_get_all_histories_for_user()
    {
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory(['user_id' => 2]);
        $this->createHistory(['user_id' => 2]);

        $this->assertCount(11, $this->history->allForUser(1));
        $this->assertCount(2, $this->history->allForUser(2));
    }

    /** @test */
    public function it_can_mark_a_history_as_read()
    {
        $history = $this->createHistory();

        $this->assertFalse($history->isRead());
        $this->history->markHistoryAsRead($history->id);

        $history->refresh();
        $this->assertTrue($history->isRead());
    }

    /** @test */
    public function it_can_get_all_unread_histories_for_user()
    {
        $this->createHistory();
        $this->createHistory(['is_read' => true]);
        $this->createHistory(['is_read' => true]);
        $this->createHistory();

        $this->assertCount(2, $this->history->allUnreadForUser(1));
    }

    /** @test */
    public function it_can_get_all_read_histories_for_user()
    {
        $this->createHistory();
        $this->createHistory(['is_read' => true]);
        $this->createHistory(['is_read' => true]);
        $this->createHistory();
        $this->createHistory();

        $this->assertCount(2, $this->history->allReadForUser(1));
    }

    /** @test */
    public function it_can_delete_all_histories_for_user()
    {
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory(['user_id' => 2]);
        $this->createHistory(['user_id' => 2]);

        $this->assertCount(3, $this->history->allForUser(1));
        $this->assertCount(2, $this->history->allForUser(2));

        $this->history->deleteAllForUser(1);

        $this->assertCount(0, $this->history->allForUser(1));
        $this->assertCount(2, $this->history->allForUser(2));
    }

    /** @test */
    public function it_can_mark_all_histories_read_for_user()
    {
        $this->createHistory();
        $this->createHistory();
        $this->createHistory();
        $this->createHistory(['user_id' => 2]);
        $this->createHistory(['user_id' => 2]);

        $this->assertCount(0, $this->history->allReadForUser(1));

        $this->history->markAllAsReadForUser(1);
        $this->assertCount(3, $this->history->allReadForUser(1));
    }

    private function createHistory(array $properties = []) : History
    {
        $data = [
            'user_id' => 1,
            'icon_class' => 'fa fa-link',
            'link' => 'http://localhost/users',
            'title' => 'My history',
            'message' => 'Is awesome!',
        ];

        return $this->history->create(array_merge($data, $properties));
    }
}
