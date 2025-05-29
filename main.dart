// import 'package:budget_b/Get.dart';

import 'package:budget_b/Get.dart';
import 'package:budget_b/home_page.dart';


import 'package:firebase_core/firebase_core.dart';
import 'firebase_options.dart';
import 'package:flutter/material.dart';



void main()async {
WidgetsFlutterBinding.ensureInitialized();
await Firebase.initializeApp(
options: DefaultFirebaseOptions.currentPlatform,
);
runApp(const MyApp());
  
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Finance Tracker',
      theme: ThemeData(primarySwatch: Colors.green, fontFamily: 'Poppins'),
      home: HomePage(),
    );
  }
}
