<?php
namespace App\Services\Data;

use Illuminate\Support\Facades\Log;
use App\Services\Utility\DatabaseException;
use PDO;
use PDOException;
use App\Models\UserModel;

/**
 * Implements CRUD operations for the USERS table
 *
 * @author Jake McDermitt
 */
class UserDAO implements IDataAccessObject
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
        Log::info("Entering UserDAO.create()");

        // Catch any database exceptions during the operation
        try {

            // Build query programatically with available parameters
            $query = "INSERT INTO `users`(`id`, `CREDENTIALS_ID`, `FIRSTNAME`, `LASTNAME`, `EMAIL`, `CITY`, `STATE`, `SUSPENDED`, `BIRTHDAY`, `TAGLINE`, `PHOTO`) VALUES (NULL, :credentials_id, :firstname, :lastname, :email, :city, :state, :suspended, :birthday, :tagline, :photo)";

            // Check if the input data is for registration
            $isRegistration = (get_class($model) == "App\Models\RegistrationModel");

            // Global user properties
            $id = $model->getId();
            $firstname = $model->getFirstname();
            $lastname = $model->getLastname();
            $email = $model->getEmail();
            $city = $model->getCity();
            $state = $model->getState();

            // Full user details properties
            if (! $isRegistration) {
                $suspended = $model->getSuspended();
                $birthday = $model->getBirthday();
                $tagline = $model->getTagline();
                $photo = $model->getPhoto();
            } else {
                $suspended = 0;
                $birthday = null;
                $tagline = null;
                $photo = null;
            }

            // Prepare the query and bind available parameters
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':credentials_id', $id);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':state', $state);
            $stmt->bindParam(':suspended', $suspended);
            $stmt->bindParam(':birthday', $birthday);
            $stmt->bindParam(':tagline', $tagline);
            $stmt->bindParam(':photo', $photo);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit UserDAO.create() with success");
                return $this->db->lastInsertId();
            } else {

                Log::info("Exit UserDAO.create() with failure. Data:{" . $model . "}");
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
        Log::info("Entering UserDAO.readAll()");

        // Catch any database exceptions during the operation
        try {

            // Build query and bind parameters
            $query = "SELECT * FROM USERS WHERE 1";

            $stmt = $this->db->prepare($query);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit UserDAO.readAll() with success");
                return $stmt;
            } else {

                Log::info("Exit UserDAO.readAll() with failure.");
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
        Log::info("Entering UserDAO.readById($id)");

        // Catch any database exceptions during the operation
        try {

            // Build query and bind parameters
            $query = "SELECT * FROM USERS WHERE CREDENTIALS_ID=:id";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result && $stmt->rowCount() == 1) {

                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $user = new UserModel($data['CREDENTIALS_ID'], null, null, $data['FIRSTNAME'], $data['LASTNAME'], $data['EMAIL'], $data['CITY'], $data['STATE'], $data['SUSPENDED'], $data['BIRTHDAY'], $data['TAGLINE'], $data['PHOTO']);
                Log::info("Exit UserDAO.readById($id) with success");
                return $user;
            } else {

                Log::info("Exit UserDAO.readById($id) with failure. Data:{id: " . $id . "}");
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
        Log::info("Entering UserDAO.readByModel()");

        // Catch any database exceptions during the operation
        try {

            // Build the query programmatically with available parameters
            $query = "SELECT * FROM USERS WHERE";

            $id = $model->getId();
            $firstname = $model->getFirstname();
            $lastname = $model->getLastname();
            $email = $model->getEmail();
            $city = $model->getCity();
            $state = $model->getState();
            $suspended = $model->getSuspended();
            $birthday = $model->getBirthday();
            $tagline = $model->getTagline();
            $photo = $model->getPhoto();

            $count = 0;
            if ($id != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " CREDENTIALS_ID=:id";
                $count ++;
            }
            if ($firstname != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " FIRSTNAME=:firstname";
                $count ++;
            }
            if ($lastname != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " LASTNAME=:lastname";
                $count ++;
            }
            if ($email != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " EMAIL=:email";
                $count ++;
            }
            if ($city != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " CITY=:city";
                $count ++;
            }
            if ($state != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " STATE=:state";
                $count ++;
            }
            if ($suspended != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " SUSPENDED=:suspended";
                $count ++;
            }
            if ($birthday != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " BIRTHDAY=:birthday";
                $count ++;
            }
            if ($tagline != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " TAGLINE=:tagline";
                $count ++;
            }
            if ($photo != null) {
                $query = $query . ($count > 0 ? " AND" : "") . " PHOTO=:photo";
                $count ++;
            }

            // Prepare the query and bind available parameters
            $stmt = $this->db->prepare($query);

            if ($id != null) {
                $stmt->bindParam(':id', $id);
            }
            if ($firstname != null) {
                $stmt->bindParam(':firstname', $firstname);
            }
            if ($lastname != null) {
                $stmt->bindParam(':lastname', $lastname);
            }
            if ($email != null) {
                $stmt->bindParam(':email', $email);
            }
            if ($city != null) {
                $stmt->bindParam(':city', $city);
            }
            if ($state != null) {
                $stmt->bindParam(':state', $state);
            }
            if ($suspended != null) {
                $stmt->bindParam(':suspended', $suspended);
            }
            if ($birthday != null) {
                $stmt->bindParam(':birthday', $birthday);
            }
            if ($tagline != null) {
                $stmt->bindParam(':tagline', $tagline);
            }
            if ($photo != null) {
                $stmt->bindParam(':photo', $photo);
            }

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit UserDAO.readByModel() with success");
                return $stmt;
            } else {

                Log::info("Exit UserDAO.readByModel() with failure. Data:{" . $model . "}");
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
        Log::info("Entering UserDAO.update()");

        // Catch any database exceptions during the operation
        try {

            // Build the query programmatically with available parameters
            $query = "UPDATE USERS SET ";

            $id = $model->getId();
            $firstname = $model->getFirstname();
            $lastname = $model->getLastname();
            $email = $model->getEmail();
            $city = $model->getCity();
            $state = $model->getState();
            $suspended = ($model->getSuspended() ? 1 : 0);
            $birthday = $model->getBirthday();
            $tagline = $model->getTagline();
            $photo = $model->getPhoto();

            $count = 0;
            if ($firstname != null) {
                $query = $query . ($count > 0 ? " ," : "") . " `FIRSTNAME`=:firstname";
                $count ++;
            }
            if ($lastname != null) {
                $query = $query . ($count > 0 ? " ," : "") . " `LASTNAME`=:lastname";
                $count ++;
            }
            if ($email != null) {
                $query = $query . ($count > 0 ? " ," : "") . " `EMAIL`=:email";
                $count ++;
            }
            if ($city != null) {
                $query = $query . ($count > 0 ? " ," : "") . " `CITY`=:city";
                $count ++;
            }
            if ($state != null) {
                $query = $query . ($count > 0 ? " ," : "") . " `STATE`=:state";
                $count ++;
            }
            if ($suspended !== null) {
                $query = $query . ($count > 0 ? " ," : "") . " `SUSPENDED`=:suspended";
                $count ++;
            }
            if ($birthday != null) {
                $query = $query . ($count > 0 ? " ," : "") . " `BIRTHDAY`=:birthday";
                $count ++;
            }
            if ($tagline != null) {
                $query = $query . ($count > 0 ? " ," : "") . " `TAGLINE`=:tagline";
                $count ++;
            }
            if ($photo != null) {
                $query = $query . ($count > 0 ? " ," : "") . " `PHOTO`=:photo";
                $count ++;
            }

            $query = $query . " WHERE CREDENTIALS_ID=:id";

            // Prepare the query and bind available parameters
            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);
            if ($firstname != null) {
                $stmt->bindParam(':firstname', $firstname);
            }
            if ($lastname != null) {
                $stmt->bindParam(':lastname', $lastname);
            }
            if ($email != null) {
                $stmt->bindParam(':email', $email);
            }
            if ($city != null) {
                $stmt->bindParam(':city', $city);
            }
            if ($state != null) {
                $stmt->bindParam(':state', $state);
            }
            if ($suspended !== null) {
                $stmt->bindParam(':suspended', $suspended);
            }
            if ($birthday != null) {
                $stmt->bindParam(':birthday', $birthday);
            }
            if ($tagline != null) {
                $stmt->bindParam(':tagline', $tagline);
            }
            if ($photo != null) {
                $stmt->bindParam(':photo', $photo);
            }

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit UserDAO.update() with success");
                return $result;
            } else {

                Log::info("Exit UserDAO.update() with failure. Data:{" . $model . "}");
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
        Log::info("Entering UserDAO.delete($id)");

        // Catch any database exceptions during the operation
        try {

            // Build the query and bind parameters
            $query = "DELETE FROM USERS WHERE CREDENTIALS_ID = :id";

            $stmt = $this->db->prepare($query);

            $stmt->bindParam(':id', $id);

            // Execute query and check result
            $result = $stmt->execute();

            if ($result) {

                Log::info("Exit UserDAO.delete() with success");
                return true;
            } else {

                Log::info("Exit UserDAO.delete() with failure");
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

