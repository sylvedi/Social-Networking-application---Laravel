<?php
namespace App\Services\Data;

use Illuminate\Support\Facades\Log;
use App\Services\Utility\DatabaseException;
use PDO;
use PDOException;

/**
 * Implements CRUD operations for the SKILLS table
 *
 * @author Jake McDermitt
 */
class SkillDAO implements IDataAccessObject
{

    private $db;

    /**
     * Instantiates the object with a database connection
     *
     * @param PDO $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     *
     * {@inheritdoc}
     * @see \App\Services\Data\IDataAccessObject::create()
     */
    public function create($model)
    {
        Log::info("Entering SkillDAO.create()");

        try {

            // Build query and bind parameters
            $query = "INSERT INTO `skills`(`id`, `USERS_ID`, `DESCRIPTION`, `YEARS`) VALUES (NULL, :users_id, :description, :years)";

            $id = $model->getId();
            $description = $model->getDescription();
            $years = $model->getYears();

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':users_id', $id);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':years', $years);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit SkillDAO.create() with success");
                return $this->db->lastInsertId();
            } else {

                Log::info("Exit SkillDAO.create() with failure. Data:{" . $model . "}");
                return false;
            }
        } catch (PDOException $e) {

            // Log database exception
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \App\Services\Data\IDataAccessObject::readAll()
     */
    public function readAll()
    {
        Log::info("Entering SkillDAO.readAll()");

        // Catch any database exceptions during the operation
        try {

            // Build query and bind parameters
            $query = "SELECT * FROM SKILLS WHERE 1";

            $stmt = $this->db->prepare($query);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit SkillDAO.readAll() with success");
                return $stmt;
            } else {

                Log::info("Exit SkillDAO.readAll() with failure.");
                return false;
            }
        } catch (PDOException $e) {
            // Log database exception
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \App\Services\Data\IDataAccessObject::readById()
     */
    public function readById($id)
    {
        Log::info("Entering SkillDAO.readById($id)");

        // Catch any database exceptions during the operation
        try {

            // Build query and bind parameters
            $query = "SELECT * FROM SKILLS WHERE USERS_ID=:id";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result && $stmt->rowCount() == 1) {

                Log::info("Exit SkillDAO.readById($id) with success");
                return $stmt;
            } else {

                Log::info("Exit SkillDAO.readById($id) with failure. Data:{id: " . $id . "}");
                return false;
            }
        } catch (PDOException $e) {
            // Log database exception
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \App\Services\Data\IDataAccessObject::readByModel()
     */
    public function readByModel($model)
    {
        Log::info("Entering SkillDAO.readByModel()");

        // Catch any database exceptions during the operation
        try {

            // Build the query programmatically with available parameters
            $query = "SELECT * FROM SKILLS WHERE";

            $id = $model->getId();
            $description = $model->getDescription();
            $years = $model->getYears();

            $count = 0;
            if ($id != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " USERS_ID=:id";
                $count ++;
            }
            if ($description != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " DESCRIPTION=:description";
                $count ++;
            }
            if ($years != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " YEARS=:years";
                $count ++;
            }

            // Prepare the query and bind available parameters
            $stmt = $this->db->prepare($query);

            if ($id != null) {
                $stmt->bindParam(':id', $id);
            }
            if ($description != null) {
                $stmt->bindParam(':description', $description);
            }
            if ($years != null) {
                $stmt->bindParam(':years', $years);
            }

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit SkillDAO.readByModel() with success");
                return $stmt;
            } else {

                Log::info("Exit SkillDAO.readByModel() with failure. Data:{" . $model . "}");
                return false;
            }
        } catch (PDOException $e) {
            // Log database exception
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \App\Services\Data\IDataAccessObject::update()
     */
    public function update($model)
    {
        Log::info("Entering SkillDAO.update()");

        // Catch any database exceptions during the operation
        try {

            // Build the query programmatically with available parameters
            $query = "UPDATE SKILLS SET ";

            $id = $model->getId();
            $description = $model->getDescription();
            $years = $model->getYears();

            $count = 0;
            if ($description != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " DESCRIPTION=:description";
                $count ++;
            }
            if ($years != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " YEARS=:years";
                $count ++;
            }

            $query = $query . " WHERE USERS_ID=:id";

            // Prepare the query and bind available parameters
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);
            if ($description != null) {
                $stmt->bindParam(':description', $description);
            }
            if ($years != null) {
                $stmt->bindParam(':years', $years);
            }

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit SkillDAO.update() with success");
                return $result;
            } else {

                Log::info("Exit SkillDAO.update() with failure. Data:{" . $model . "}");
                return false;
            }
        } catch (PDOException $e) {

            // Log database exception
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \App\Services\Data\IDataAccessObject::delete()
     */
    public function delete($id)
    {
        Log::info("Entering SkillDAO.deleteById($id)");

        // Catch any database exceptions during the operation
        try {

            // Build the query and bind parameters
            $query = "DELETE FROM SKILLS WHERE USERS_ID = :id";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit SkillDAO.deleteById() with success");
                return true;
            } else {

                Log::info("Exit SkillDAO.deleteById() with failure");
                return false;
            }
        } catch (PDOException $e) {

            // Log database exception
            Log::error("Exception: ", array(
                "message" => $e->getMessage()
            ));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
}