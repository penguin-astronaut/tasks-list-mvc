<?php

namespace Models;

class Tasks extends \Core\Model
{
    public const STATUS_READY = 'ready';
    public const STATUS_UNREADY = 'unready';

    /**
     * @param int $userId
     * @return array
     */
    public function get(int $userId): array
    {
        $stm = $this->db->prepare('SELECT * FROM tasks WHERE user_id = ?');
        $stm->execute([$userId]);
        return $stm->fetchAll() ?: [];
    }

    /**
     * @param string $description
     * @param int $userId
     * @return array|string[]
     */
    public function create(string $description, int $userId): array
    {
        $description = trim(htmlspecialchars($description));
        if (!$description) {
            return [
                'status' => 'error',
                'message' => 'field description required!'
            ];
        }

        $sql = "INSERT INTO tasks (user_id, description, status) VALUES (?,?,?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId, $description, self::STATUS_UNREADY]);

        return [
            'status' => 'success',
            'task_id' => $this->db->lastInsertId()
        ];
    }

    /**
     * @param int $taskId
     * @param int $userId
     * @return void
     */
    public function remove(int $taskId, int $userId): void
    {
        $sql = "DELETE FROM tasks WHERE id=? AND user_id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$taskId, $userId]);
    }

    /**
     * @param int $userId
     * @return void
     */
    public function removeAll(int $userId): void
    {
        $sql = "DELETE FROM tasks WHERE user_id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
    }

    /**
     * @param int $taskId
     * @param int $userId
     * @param string $status
     * @return void
     */
    public function changeStatus(int $taskId, int $userId, string $status): void
    {
        $sql = "UPDATE tasks SET status=? WHERE id=? AND user_id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$status, $taskId, $userId]);
    }

    /**
     * @param int $userId
     * @return void
     */
    public function readyAll(int $userId): void
    {
        $sql = "UPDATE tasks SET status=? WHERE user_id=?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([self::STATUS_READY, $userId]);
    }
}