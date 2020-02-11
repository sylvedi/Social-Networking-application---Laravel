<?php
namespace App\Services\Data;

use Illuminate\Support\Facades\Log;
use App\Services\Utility\DatabaseException;
use PDO;
use PDOException;

/**
 * Implements CRUD operations for the CREDENTIALS table
 *
 * @author Jake McDermitt
 */
class CredentialDAO implements IDataAccessObject
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
        Log::info("Entering CredentialsDAO.create()");

        try {

            // Build query and bind parameters
            $query = "INSERT INTO `credentials`(`id`, `USERNAME`, `PASSWORD`) VALUES (NULL, :username, :password)";

            $username = $model->getUsername();
            $password = $model->getPassword();

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit CredentialsDAO.create() with success");
                return $this->db->lastInsertId();
            } else {

                Log::info("Exit CredentialsDAO.create() with failure. Data:{" . $model . "}");
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
        Log::info("Entering CredentialDAO.readAll()");

        // Catch any database exceptions during the operation
        try {

            // Build query and bind parameters
            $query = "SELECT * FROM CREDENTIALS WHERE 1";

            $stmt = $this->db->prepare($query);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit CredentialDAO.readAll() with success");
                return $stmt;
            } else {

                Log::info("Exit CredentialDAO.readAll() with failure.");
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
        Log::info("Entering CredentialsDAO.readById($id)");

        // Catch any database exceptions during the operation
        try {

            // Build query and bind parameters
            $query = "SELECT * FROM CREDENTIALS WHERE ID=:id";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result && $stmt->rowCount() == 1) {

                Log::info("Exit CredentialsDAO.readById($id) with success");
                return $stmt;
            } else {

                Log::info("Exit CredentialsDAO.readById($id) with failure. Data:{id: " . $id . "}");
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
        Log::info("Entering CredentialsDAO.readByModel()");

        // Catch any database exceptions during the operation
        try {

            // Build the query programmatically with available parameters
            $query = "SELECT * FROM CREDENTIALS WHERE";

            $id = $model->getId();
            $username = $model->getUsername();
            $password = $model->getPassword();

            $count = 0;
            if ($id != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " id=:id";
                $count ++;
            }
            if ($username != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " USERNAME=:username";
                $count ++;
            }
            if ($password != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " PASSWORD=:password";
                $count ++;
            }

            // Prepare the query and bind available parameters
            $stmt = $this->db->prepare($query);

            if ($id != null) {
                $stmt->bindParam(':id', $id);
            }
            if ($username != null) {
                $stmt->bindParam(':username', $username);
            }
            if ($password != null) {
                $stmt->bindParam(':password', $password);
            }

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit CredentialsDAO.readByModel() with success");
                return $stmt;
            } else {

                Log::info("Exit CredentialsDAO.readByModel() with failure. Data:{" . $model . "}");
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
        Log::info("Entering CredentialsDAO.update()");

        // Catch any database exceptions during the operation
        try {

            // Build the query programmatically with available parameters
            $query = "UPDATE CREDENTIALS SET ";

            $id = $model->getId();
            $username = $model->getUsername();
            $password = $model->getPassword();

            $count = 0;
            if ($username != null) {
                $query = $query . ($count > 0 ? " ," : "") . " `USERNAME`=:username";
                $count ++;
            }
            if ($password != null) {
                $query = $query . ($count > 0 ? " ," : "") . " `PASSWORD`=:password";
                $count ++;
            }

            $query = $query . " WHERE ID=:id";

            // Prepare the query and bind available parameters
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);
            if ($username != null) {
                $stmt->bindParam(':username', $username);
            }
            if ($password != null) {
                $stmt->bindParam(':password', $password);
            }

            // Execute query and check result
            $result = $stmt->execute();
            if ($result) {

                Log::info("Exit CredentialsDAO.update() with success");
                return $stmt;
            } else {

                Log::info("Exit CredentialsDAO.update() with failure. Data:{" . $model . "}");
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
        Log::info("Entering CredentialsDAO.delete($id)");

        // Catch any database exceptions during the operation
        try {

            // Build the query and bind parameters
            $query = "DELETE FROM CREDENTIALS WHERE ID = :id";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit CredentialsDAO.delete() with success");
                return true;
            } else {

                Log::info("Exit CredentialsDAO.delete() with failure");
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