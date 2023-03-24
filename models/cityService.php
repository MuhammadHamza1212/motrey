<?php

include "city.php";

class CityService
{
    public function addCity($city)
    {
        global $conn;
		$city_id_sal = $city->getCity_id_sal();
		$language = $city->getLanguage();
        $name = $city->getName();
        $country_id = $city->getCountry_id();
        $sql = $conn->prepare("INSERT INTO cities (city_id_sal, language, name, country_id) VALUES (?, ?, ?, ?)");
        $sql->bind_param("issi", $name, $country_id);
        $sql->execute();
    }

    public function getCityByCityId($id)
    {
        global $conn;
        $sql = "SELECT * FROM cities WHERE city_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $city = new City();
			$city->setCity_id_sal($row["city_id_sal"]);
			$city->setLanguage($row["language"]);
            $city->setCity_id($row["city_id"]);
            $city->setName($row["name"]);
            $city->setCountry_id($row["country_id"]);
            return $city;
        }
    }

    public function getCityByName($name)
    {
        global $conn;
        $sql = "SELECT * FROM cities WHERE name='$name'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $city = new City();
			$city->setCity_id_sal($row["city_id_sal"]);
			$city->setLanguage($row["language"]);
            $city->setCity_id($row["city_id"]);
            $city->setName($row["name"]);
            $city->setCountry_id($row["country_id"]);
            return $city;
        }
    }

    public function getCityByCountryId($id)
    {
        global $conn;
        $sql = "SELECT * FROM cities WHERE country_id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $citiesObjects = array();
            while ($row = $result->fetch_assoc()) {
                $city = new City();
				$city->setCity_id_sal($row["city_id_sal"]);
				$city->setLanguage($row["language"]);
                $city->setCity_id($row["city_id"]);
                $city->setName($row["name"]);
                $city->setCountry_id($row["country_id"]);
                array_push($citiesObjects, $city);
            }
            return $citiesObjects;
        }
    }

    public function updateCityByCityId($city)
    {
        global $conn;
        $city_id = $city->getcity_id();
		$city_id_sal = $city->getCity_id_sal();
		$language = $city->getLanguage();
        $name = $city->getName();
        $country_id = $city->getCountry_id();
        $sql = $conn->prepare("UPDATE cities SET city_id_sal=?, language=?, name=?, country_id=? WHERE city_id=?");
        $sql->bind_param("issii", $city_id_sal, $language, $name, $country_id, $city_id);
        $sql->execute();
    }

    public function deleteCityByCityId($id)
    {
        global $conn;
        $sql = "DELETE FROM cities WHERE city_id=$id";
        $result = $conn->query($sql);
    }

    public function deleteCityByCountryId($id)
    {
        global $conn;
        $sql = "DELETE FROM cities WHERE country_id=$id";
        $result = $conn->query($sql);
    }

    public function getAllCities()
    {
        global $conn;
        $sql = "SELECT * FROM cities";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $citiesObjects = array();
            while ($row = $result->fetch_assoc()) {
                $city = new City();
				$city->setCity_id_sal($row["city_id_sal"]);
				$city->setLanguage($row["language"]);
                $city->setCity_id($row["city_id"]);
                $city->setName($row["name"]);
                $city->setCountry_id($row["country_id"]);
                array_push($citiesObjects, $city);
            }
            return $citiesObjects;
        }
    }
}
