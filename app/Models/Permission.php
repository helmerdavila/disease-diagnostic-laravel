<?php

namespace Tesis\Models;

use Zizaco\Entrust\EntrustPermission;

/**
 * Tesis\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Tesis\Models\Role[] $roles
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Permission whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Permission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Permission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\Tesis\Models\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permission extends EntrustPermission
{
}
