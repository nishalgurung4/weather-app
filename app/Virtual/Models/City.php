<?php

namespace App\Virtual\Models;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @OA\Schema(
 *     title="City",
 *     description="City model",
 *     @OA\Xml(
 *         name="City"
 *     )
 * )
 */
class City
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private integer $id;

    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name",
     *      example="Tokyo"
     * )
     *
     * @var string
     */
    public string $name;

    /**
     * @OA\Property(
     *      title="Longitude",
     *      description="Longitude of the city",
     *     example=-0.1257
     * )
     *
     * @var float
     */
    public float $longitude;

    /**
     * @OA\Property(
     *      title="Latitude",
     *      description="Latitude of the city",
     *     example=51.5085
     * )
     *
     * @var float
     */
    public float $latitude;

}
