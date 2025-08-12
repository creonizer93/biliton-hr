<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Cluster;

class ClusterController extends Controller
{
    public function index()
    {
        $clusters = Cluster::all();
        return Inertia::render('Clusters/Index', [
            'clusters' => $clusters,
        ]);
    }

    public function create()
    {
        return Inertia::render('Clusters/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Cluster::create($request->all());

        return redirect()->route('clusters.index')->with('success', 'Cluster created successfully.');
    }

    public function edit(Cluster $cluster)
    {
        return Inertia::render('Clusters/Edit', [
            'clusters' => $cluster,
        ]);
    }
    public function update(Request $request, Cluster $cluster)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $cluster->update($request->all());

        return redirect()->route('clusters.index')->with('success', 'Cluster updated successfully.');
    }
    public function destroy(Cluster $cluster)
    {
        $cluster->delete();

        return redirect()->route('clusters.index')->with('success', 'Cluster deleted successfully.');
    }
}
