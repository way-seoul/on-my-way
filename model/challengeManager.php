<?php

class ChallengeManger {
    public function deletePlace($place_id)
    {
        $this->delete('places', $place_id);
    }

    public function editPlace($place_id, $formData)
    {
        $db = Manager::connectDB();
        $edit_places = $db->prepare(
            "UPDATE places SET " . "
            name = ?,
            map_provider = ?,
            map_link = ?,
            memo = ?,
            rating = ?
            " . "WHERE id = ?"
        );
        $edit_places->execute([
            $formData['name'],
            $formData['map_provider'],
            $formData['map_link'],
            $formData['memo'],
            $formData['rating'],
            $place_id
        ]);
    }
}

